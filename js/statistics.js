const SETUP_FILE = '../config/setup.json';
const NUMBER_OF_BUCKETS = 25;
const DEFAULT_LOG_PATH = 'hits.log';

let setup = null;
let data = null;

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
			$('#error-msg').html('<div class="alert alert-danger" role="alert">' + t.error_loading_setup_file + '</div>');
		})
		.then(function () {
			$.ajax({
                url: setup.statistics.log || DEFAULT_LOG_PATH,
                success: (csvdata) => {
                    let stampArrays = $.csv.toArrays(csvdata, { separator: ';' });
					data = getStampsById(stampArrays);
                    let allStamps = stampArrays.map(stampIdAndStamp => stampIdAndStamp[1]);
                    
                    if (allStamps.length > 0) {
                        const minStamp = parseInt(allStamps[0]);
                        const range = allStamps[allStamps.length - 1] - minStamp;
                        let bucketSize = Math.round(range / (NUMBER_OF_BUCKETS-1));
                        bucketSize = bucketSize > 0 ? bucketSize : 1;

                        let buckets = Array.from(new Array(NUMBER_OF_BUCKETS), (_, index) => minStamp+(index*bucketSize));

                        createChart($('#chart'), buckets);
                        fillStatistics();
                    } else {
                        $('#chartContainer').html('<div class="alert alert-primary" role="alert" style="margin-top: 1em">' + t.no_log_data + '</div>')
                    }
				},
                error: () => {
                    $('#error-msg').html('<div class="alert alert-danger" role="alert">' + t.error_loading_log_file + '</div>');
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

function getStampsById(rawData) {
    return {
        de: {
            enter: getStamps(rawData, "de-enter"),
            start: getStamps(rawData, "de-start"),
            result: getStamps(rawData, "de-result")
        },
        en: {
            enter: getStamps(rawData, "en-enter"),
            start: getStamps(rawData, "en-start"),
            result: getStamps(rawData, "en-result")
        }
    }
}

function getStamps(rawData, idOrIds) {
    var searchIds = typeof idOrIds === 'string' ? [idOrIds] : idOrIds;
    return rawData
        .filter(row => searchIds.includes(row[0]))
        .map(searchedRow => parseInt(searchedRow[1]));
}

function fillStatistics() {
    $('#de-enter').html(data.de.enter.length);
    $('#de-start').html(data.de.start.length);
    $('#de-result').html(data.de.result.length);
    $('#en-enter').html(data.en.enter.length);
    $('#en-start').html(data.en.start.length);
    $('#en-result').html(data.en.result.length);
    $('#stamp').html(new Date().toLocaleString('de'));
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
            datasets: [{
                label: 'Aufrufe (Deutsch)',
                data: getClicksPerBucket(data.de.enter, buckets),
                fill: false,
                borderColor: [
                    'rgba(0, 0, 0, 1)'
                ],
                borderWidth: 1
            },
            {
                label: 'Starts (Deutsch)',
                data: getClicksPerBucket(data.de.start, buckets),
                fill: false,
                borderColor: [
                    'rgba(255, 200, 0, 1)'
                ],
                borderWidth: 1
            },
            {
                label: 'Abschlüsse (Deutsch)',
                data: getClicksPerBucket(data.de.result, buckets),
                fill: false,
                borderColor: [
                    'rgba(255, 100, 100, 1)'
                ],
                borderWidth: 1
            },
            
            {
                label: 'Aufrufe (Englisch)',
                data: getClicksPerBucket(data.en.enter, buckets),
                fill: false,
                borderColor: [
                    'rgba(0, 0, 150, 1)'
                ],
                borderWidth: 1
            },
            {
                label: 'Starts (Englisch)',
                data: getClicksPerBucket(data.en.start, buckets),
                fill: false,
                borderColor: [
                    'rgba(100, 100, 100, 1)'
                ],
                borderWidth: 1
            },
            {
                label: 'Abschlüsse (Englisch)',
                data: getClicksPerBucket(data.en.result, buckets),
                fill: false,
                borderColor: [
                    'rgba(150, 0, 0, 1)'
                ],
                borderWidth: 1
            }
            ]
        }
    });
}