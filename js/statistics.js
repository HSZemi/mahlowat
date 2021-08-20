const SETUP_FILE = '../config/setup.json';
const NUMBER_OF_BUCKETS = 25;
const DEFAULT_LOG_PATH = 'hits.log';
const DEFAULT_CHECKPOINT_PREFIX = 'Sonstige';

let setup = null;
let data = null;
let alreadyShownUnknownCheckpoints = {};

// translation instance, see lang/*.js files
var t = new T();

function translate() {
	for (let prop in t) {
		let id = prop.replace(/_/g, '-');
		$('#' + id).html(t[prop]);
	}
}

$(() => {
	translate();
    init();
})

function init() {
	$.getJSON(SETUP_FILE)
		.done(function (jsondata) {
			setup = jsondata;
		})
		.fail(function () {
			$('#error-msg').append('<div class="alert alert-danger" role="alert">' + t.error_loading_setup_file + '</div>');
		})
		.then(function () {
			$.ajax({
                url: setup.statistics.log || DEFAULT_LOG_PATH,
                success: (csvdata) => {
                    const idsAndStamps = $.csv.toArrays(csvdata, { separator: ';' });
					data = getStampsById(idsAndStamps);
                    let allStamps = idsAndStamps.map(idAndStamp => idAndStamp[1]);
                    
                    if (allStamps.length > 0) {
                        const minStamp = parseInt(allStamps[0]);
                        const range = allStamps[allStamps.length - 1] - minStamp;
                        let bucketSize = Math.round(range / (NUMBER_OF_BUCKETS-1));
                        bucketSize = bucketSize > 0 ? bucketSize : 1;

                        let buckets = Array.from(new Array(NUMBER_OF_BUCKETS), (_, index) => minStamp+(index*bucketSize));

                        createStatistics();
                        createChart($('#chart'), buckets);
                    } else {
                        $('#chartContainer').html('<div class="alert alert-primary" role="alert" style="margin-top: 1em">' + t.no_log_data + '</div>')
                    }
				},
                error: () => {
                    $('#error-msg').append('<div class="alert alert-danger" role="alert">' + t.error_loading_log_file + '</div>');
                }
            });
		});
}

function getClicksPerBucket(stamps, buckets) {
    let stampIndex = 0;
    let clicksPerBucket = [0]
    buckets.forEach((maxStampForBucket, bucketIndex) => {
        while (stamps[stampIndex] < maxStampForBucket) {
            clicksPerBucket[bucketIndex]++;
            stampIndex++;
        }
        clicksPerBucket.push(clicksPerBucket[bucketIndex]);
    });
    return clicksPerBucket;
}

/**
 * The user can define custom checkpointIds in setup.statistics.checkpoints which are stored in the CSV to identify the checkpoints.
 * This can look like: setup.statistics.checkpoints = {
 *      enter: "callPage"
 *      start: ""
 * }
 * Here, the checkpoint `enter` has the custom Id `callPage`, while the checkpoint `start` has no custom Id, thus falling back to `start` as Id.
 * @returns All checkpointIds (custom or default) enabled in the setup file.
 */
function getCheckpointIds() {
    return Object.entries(setup.statistics.checkpoints)
        .map(customAndDefaultId => {
            const [defaultCheckpointId, customCheckpointId] = customAndDefaultId;
            return customCheckpointId || defaultCheckpointId
        });
}

function getPrefixAndId(checkpoint, knownIds) {
    for (let i=0; i<knownIds.length; i++) {
        if (checkpoint.endsWith(knownIds[i])) {
            const prefix = checkpoint.slice(0, -knownIds[i].length);
            const id = checkpoint.slice(-knownIds[i].length);
            return [prefix || DEFAULT_CHECKPOINT_PREFIX, id];
        }
    }
    return [DEFAULT_CHECKPOINT_PREFIX, checkpoint];
}

function getStampsById(rawData) {
    let result = {};
    const ids = getCheckpointIds();
    rawData.forEach(row => {
        const checkpoint = row[0];
        const stamp = row[1];
        const [prefix, checkpointId] = getPrefixAndId(checkpoint, ids);
        if (!result[prefix]) result[prefix] = {}
        if (!result[prefix][checkpointId]) result[prefix][checkpointId] = []
        result[prefix][checkpointId].push(stamp);
    });
    return result;
}

function getGroupName(prefix) {
    if (!setup.statistics.groups) return prefix;
    const group = setup.statistics.groups.find(group => group.prefix === prefix);
    if (!group && prefix !== DEFAULT_CHECKPOINT_PREFIX) {
        showUnknownCheckpointPrefixWarning(prefix);
    }
    return group ? group.name : prefix;
}

function generateColumn(content) {
    return $(`<td>${content}</td>`);
}

function generateRow(name) {
    let caption = '';
    switch (name) {
        case 'enter':
            caption = 'Website-Aufrufe:'
            break;
        case 'start':
            caption = 'Vote-O-Mat begonnen:'
            break;
        case 'result':
            caption = 'Vote-O-Mat beendet:'
            break;
        default:
            caption = '';
            break;
    }
    return $(`<tr><td>${caption}</td></tr>`);
}

function createStatistics() {
    $('#stamp').html(new Date().toLocaleString('de'));

    /* generate column headers */
    const row = $('#table_head_row');
    Object.keys(data).forEach(prefix => {
        row.append(generateColumn(getGroupName(prefix)));
    });

    /* generate content */
    const table = $('#table_body');
    const checkpointIds = Object.keys(data[Object.keys(data)[0]]);
    checkpointIds.forEach(checkpointId => {
        const row = generateRow(checkpointId);
        Object.keys(data).forEach(prefix => {
            const numberOfEntries = data[prefix][checkpointId] ? data[prefix][checkpointId].length : 0;
            row.append(generateColumn(numberOfEntries));
        });
        table.append(row);
    });

    
}

function getLabelForDataset(prefix, checkpointId) {
    const language = `(${getGroupName(prefix)})`;
    let checkpointType = '';
    switch (checkpointId) {
        case 'enter':
            checkpointType = 'Aufrufe';
            break;
        case 'start':
            checkpointType = 'Starts';
            break;
        case 'result':
            checkpointType = 'Abschlüsse';
            break;
        default:
            checkpointType = checkpointId;
            showUnknownCheckpointIdWarning(checkpointId);
            break;
    }
    return `${checkpointType} ${language}`;
}

// from https://stackoverflow.com/questions/1484506/random-color-generator
function generateRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }

function generateDataset(prefix, checkpointId, buckets) {
    return {
        label: getLabelForDataset(prefix, checkpointId),
        data: getClicksPerBucket(data[prefix][checkpointId], buckets),
        fill: false,
        borderColor: [
            generateRandomColor()
        ],
        borderWidth: 1
    }
}

function generateDatasets(buckets) {
    const result = [];
    Object.keys(data).forEach(prefix => {
        Object.keys(data[prefix]).forEach(checkpointId => {
            result.push(generateDataset(prefix, checkpointId, buckets));
        });
    });
    return result;
}

function showUnknownCheckpointIdWarning(checkpointId) {
    if (alreadyShownUnknownCheckpoints[`id:${checkpointId}`]) return;
    alreadyShownUnknownCheckpoints[`id:${checkpointId}`] = true;
    $('#error-msg').append(`<div class="alert alert-warning" role="alert">${t.warning_unknown_checkpoint_id}"${checkpointId}"</div>`);
}

function showUnknownCheckpointPrefixWarning(checkpointPrefix) {
    if (alreadyShownUnknownCheckpoints[`prefix:${checkpointPrefix}`]) return;
    alreadyShownUnknownCheckpoints[`prefix:${checkpointPrefix}`] = true;
    $('#error-msg').append(`<div class="alert alert-warning" role="alert">${t.warning_unknown_checkpoint_prefix}"${checkpointPrefix}"</div>`);
}

function createChart(ctx, buckets) {
    let chart = new Chart(ctx, {
        type: 'line',
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: (context) => {
                            const originalLabel = `${context.dataset.label} ${context.formattedValue}`;
                            if (context.dataIndex === 0) return originalLabel;
                            const difference = context.dataset.data[context.dataIndex] - context.dataset.data[context.dataIndex-1];
                            return `${originalLabel} ${difference === 0 ? `(±${difference})` : `(+${difference})`}`;
                        }
                    }
                }
            }
        },
        data: {
            labels: buckets.map(stamp => new Date(stamp*1000).toLocaleString('de')),
            datasets: generateDatasets(buckets)
        }
    });
}