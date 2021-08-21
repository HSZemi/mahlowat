![Mahlowat](img/mahlowat_logo.png)

[Deutsche Version](README-DE.md)

Vote-O-Mat is a more feature-rich implementation of the voting advice application [mahlowat](https://github.com/HSZemi/mahlowat). Both allow users to compare their opinion on selected theses to the opinions of groups or individuals competing in an election.

Vote-O-Mat makes it easier to offer *mahlowat* in multiple languages, adjust its appearance to a brand, and can offer anonymous usage statistics ([see privacy-related information](#privacy)). If you do not need any of these features, you are probably better off using [mahlowat](https://github.com/HSZemi/mahlowat).


# General Approach

There will be an election at some point in the future. A team of highly skilled individuals devises a list of simple theses which can be answered with Yes or No.

Once the groups or candidates participating in the election are set, they are being sent the theses and asked to provide a positioning (Yes/No/Neutral) and a short statement for each thesis.

One person sets up the basic Vote-O-Mat.

Some poor souls will then compile all responses into one configuration file for each language.

The Vote-O-Mat is consequently advertised.

Enjoy!


# <a name="GettingStarted"></a>Getting Started

A Vote-O-Mat is structured into:

- **Vote-O-Mat** itself, which provides a landing page with all available languages
- One or more **Vote-O-Mat instances** (`vom-instance`), one instance for every available language
- A **statistics module** (`vom-statistics`), responsible for creating and displaying the anonymous usage statistics

In order to get Vote-O-Mat up and running, you have to do three things:

- Upload all files to a web server.
- Create a general *setup file* which contains settings for branding, information on the available Vote-O-Mat languages and statistics configurations.
- Create one Vote-O-Mat instance for each language.

For future reference: outline of the Vote-O-Mat's directory (in excerpts):

```
vote-o-mat                      # root directory of Vote-O-Mat
|--- config
|    |--- setup.json            # setup file containing Vote-O-Mat settings
|--- vom-instance               # template for a Vote-O-Mat instance
|    |--- config
|    |    |--- data.json        # configuration file for the respective Vote-O-Mat instance
|    |--- generator.html        # configuration tool for config/data.json
|    |--- index.html            # web page of the Vote-O-Mat instance
|--- vom-statistics
|    |--- hits.log              # log file containing all statistics data
|    |--- index.html            # web page showing Vote-O-Mat statistics
|--- index.html                 # landing page showing all available Vote-O-Mat languages
|--- setup.html                 # setup tool for config/setup.json
```

## Installation

Download Vote-O-Mat into a directory of your choice using the green `Code` button in the top right hand corner of the GitHub website.

## <a name="upload"></a>Upload

Upload the *content of the root directory `vote-o-mat`* (not the folder `vote-o-mat`) to your web server.

For this guide, we assume your web server can be accessed at `https://example.com`.

 **Notice:** The Vote-O-Mat is usually visible for everyone once you have uploaded the files. If this is no option for you, work through *General Setup* and *Create Instances* first. Notice that this order can lead to a more cumbersome setup process.

## General Setup

Set up the basic Vote-O-Mat:

- Open the setup tool `setup.html` in the root directory.
    - Do so by opening the URL `https://example.com/setup.html` in your browser (if you have already uploaded the files).
- Walk through the setup process.
    - During setup, you need to fill in links to the individual Vote-O-Mat instances. If you do not know them yet, leave them blank for now and fill them in after setting everything else up.
    - You can also enable statistics for your Vote-O-Mat. [Learn more about Statistics](#statistics)
- The setup tool generates a cryptic text at the end.
- Copy this text into `config/setup.json`.
    - If the file does not exist in the `config` directory, simply create it. Make sure the file is saved as `UTF-8` encoding.

If you later need to make changes to `config/setup.json`, just open `setup.html` again. It loads all data from an existing `config/setup.json`, so you do not have to start from scratch.

***Sidenote**: If the `config/setup.json` cannot be loaded, i.e. because you are doing the setup before uploading the files, the setup tool will prompt you a text field on the first page as a workaround. Manually copy the content of an existing `config/setup.json` into this field to make changes to it.*

## Create Instances

You need to create one Vote-O-Mat instance for each language. This can be quite lengthy, so you might want to have multiple people, each configuring a different instance.

- In the root directory: create as many Vote-O-Mat instances as you need.
    - Do so by copying the template directory `vom-instance` (you can also use the template directory itself as an instance).
- Repeat the following process for each instance:
    - Rename the instance's folder (not the root directory) to suit the anticipated language.
        - Example: rename the folder to `en` if it contains the English Vote-O-Mat instance.
    - Open the configuration tool `generator.html` (located inside the instance's directory).
    - Walk through the configuration process.
        - You need to add all theses, electable groups or candidates, and their answers.
        - Also set the language of the Vote-O-Mat instance. If you have not uploaded the files before, no language is going to be available. Skip this step for now.
    - Copy and save the text created by the configuration tool in `config/data.json` (located inside the instance's directory)
        - Create the file if it does not yet exis. Save it using `UTF-8` encoding. You know the drill.
    - Set the display language (e.g. button captions). [Learn how to do that](#DisplayLanguage)

I bet you already guessed it, but for completeness: like the setup tool, the configuration tool also loads existing `config/data.json` files so you can easily make changes to the file. If this is not possible, it again prompts you ... a text field? No, **two** text fields! One for entering `../config/setup.json` (from the `config` in the root directory) and one for the instance's `config/data.json`.

## Finishing Touches

Congratulations, you are through the vast majory of the setup process :)

If you have not [uploaded the files](#upload), do so now.

If you have not set the links to the Vote-O-Mat instances, do so now:

- Open `setup.html` in the root directory.
- Enter the links to the Vote-O-Mat instances.
    - Supposed you named the instances `de` and `en` when creating them. The links are then `https://example.com/de` and `https://example.com/en`.
- Save the setup text again in `config/setup.json` (in the root directory).

If you have not set the Vote-O-Mat instances yet (i.e. because you have not uploaded the files before), do so now:  
Repeat for every instance:

- Open `generator.html` (in the instance's directory).
- Advance to the language setting.
- Select the language appropriate.
- Save the configuration text again in `config/data.json` (in the instance's directory).

Finally, only keep those files and folders on the web server that are listed in the following.  
Delete all other files.

- The folders `config`, `css`, `img`, `js`, and `lang` (and their content)
- The file `index.html` (in the root directory)
- The folders of all Vote-O-Mat instances (and their content)
- *If statistics are enabled:* the folder `vom-statistics` and its content

Done!

## Accessing

Supposed you uploaded the Vote-O-Mat files at `https://example.com` and created two instances named `de` and `en`.

You can access the landing page with all available languages at `https://example.com`.

The individual Vote-O-Mat instances are accessible at `https://example.com/de` and `https://example.com/en` (or via the landing page).

You can open the statistics dashboard at `https://example.com/vom-statistics`. [Learn how to customize this link](#StatisticsDashboard).

# Calculations

The points for the groups in the results at the end are calculated as follows: 

 - The user's answers are compared to each group's answers.
 - The group gains 2 points for each thesis where their answer matches the user's.
 - A slight deviation (yes/neutral or neutral/no) gains the group still 1 point.
 - If the answers are contrary or if a group has no position on a thesis, the group gains no point.
 - A thesis that the user skipped gains no one any point. The maximum number of points possible decreases.
 - A thesis that the user counts double gets groups twice the points (0/2/4). This increases the maximum number of points possible.

# Details for Nerds

## <a name="DisplayLanguage"></a>Set Display Language

Vote-O-Mat comes with three languages: German (de\_de, default), English (en\_gb) and French (fr\_fr).

If you want to change the display language if a Vote-O-Mat instance, you have to do a tiny edit in `index.html`. Go to the very bottom, where you will find this section:
```
<!-- Select (uncomment) exactly one of the following languages-->
<script src="../lang/de_de.js"></script>
<!-- <script src="../lang/en_gb.js"></script> -->
<!-- <script src="../lang/fr_fr.js"></script> -->
<!-- end languages-->
```

To change the active language, comment out the currently active language (comment out = enclose the whole line in `<!--` and `-->`)
and uncomment the language of your choice (removing the `<!--` and `-->`). Example: If you want to run Mahlowat in french, it should
look like this:

```
<!-- Select (uncomment) exactly one of the following languages-->
<!-- <script src="../lang/de_de.js"></script> -->
<!-- <script src="../lang/en_gb.js"></script> -->
<script src="../lang/fr_fr.js"></script>
<!-- end languages-->
```

You may also want to change some of the text, especially the Q&A part. In order to do that, directly edit the language `*.js` files which you can find in the `../lang` subfolder in the root directory. 

You can use html tags inside of the strings. Just make sure to not introduce errors in the JavaScript, because that will unfortunately
break the whole application. If you are unsure, maybe ask a friend for help.

**Attention!** In order to support Internet Explorer 11 (lol), [babel](https://babeljs.io) has been used to transpile the language files from a raw version (e.g. `en_gb.raw.js`) into the production version (e.g. `en_gb.js`).
You can edit the "raw" files and then do that yourself – or edit the transpiled production versions directly.

```
npm install --save-dev @babel/core @babel/cli @babel/preset-env @babel/node
babel --presets @babel/preset-env lang/de_de.raw.js > lang/de_de.js
babel --presets @babel/preset-env lang/en_gb.raw.js > lang/en_gb.js
babel --presets @babel/preset-env lang/fr_fr.raw.js > lang/fr_fr.js
```

## <a name="statistics"></a>Statistics

### What can I do with the Statistics?

The statistics dashboard of Vote-O-Mat has two features:

- A table showing how often the Vote-O-Mat was used
- A chart showing the usage over time

The usage can be split up into these categories:

- Number of users opening the Vote-O-Mat website
- Number of users starting the Vote-O-Mat (i.e. pressing 'Start')
- Number of users finishing the Vote-O-Mat (i.e. see the results)

It is also possible to group the usage by language.

With these tools, questions like the following may be answered:

- How many people have used the Vote-O-Mat?
- Is the effort (for a particular language) worth it?
- Do visitors actually finish the Vote-O-Mat?
- Which advertising means have significant impact? (Supposed the advertising means are published at different times, so certain spikes can be attributed to a particular mean)

It is also possible to use the raw data to run more sophisticated analyses. One could try to estimate the average duration users need to absolve the Vote-O-Mat. Or evaluate which advertising mean generates users which actually absolve the Vote-O-Mat. In the end, it is up to the analyst what can be read out of the data.

**Note:** The statistics dashboard and the raw data can be accessed by anyone. [Learn why](#DataProtection)

### <a name="DataCollection"></a>How does the data collection work?

The Vote-O-Mat contains predefined *checkpoints*. These are specific actions within the application. Checkpoints are:

- *enter*: the intro page of a Vote-O-Mat instance is displayed
- *start*: the start button on the intro page or the restart button on the result page were clicked, now displaying the first thesis
- *result* the results are displayed after a (re)start of the Vote-O-Mat instance (going back on the result page to adjust the answers does not count into the statistics)

Each checkpoint can be activated separately. Only then it is part of the collected data. By default, all checkpoints are disabled, thus no data is collected, and no statistics are available.

Every time an activated checkpoint is entered, the Vote-O-Mat instance sends the checkpoint ID (*enter*, *start*, or *result*, or a custom name for these) to the statistics module. The ID can be preceeded by a prefix like *de-* which can be set for each Vote-O-Mat instance and makes it possible to differentiate usages between languages.

The statistic module logs every incoming checkpoint ID (and prefix) together with a timestamp in a [CSV](https://en.wikipedia.org/wiki/Comma-separated_values)-file. This looks like follows:

```
de-enter;1625303227182
de-start;1625303229297
en-enter;1625333857740
en-start;1625333858632
en-result;1625334140898
de-enter;1625399796756
de-start;1625399797504
de-result;1625399970330
```

### <a name="privacy"></a>What about Privacy?

You may ask

> Statistics in an election-related software? But what about privacy!?

If you do not, you should. Privacy is always important, even more in this context. That is why Vote-O-Mat only collects a minimum of data, all anonymous. [As described](#DataCollection), Vote-O-Mat does not log any personal information.

### <a name="DataProtection"></a>How is the collected data protected?

It is not. As the retrieved data does not contain any personal information, a protection of the data has no priority. That is why the log file is not encrypted and why the log file and the statistic dashboard have no password protection.

That being said, feel free to add these features!

## Logging on Steroids - Advanced Statistics Settings

Let's take a closer look at the statistics module and how it can be configured in detail. [Learn how the statistics work first](#privacy)

### Basics

By default, the data is logged chronologically in a log file called `hits.log`, placed in `vom-statistics/hits.log`. It uses the [CSV format](https://en.wikipedia.org/wiki/Comma-separated_values), the values are separated with `;`. Thus, the file can be easily opened and analyzed using software like Microsoft Excel.

The collected data looks as follows:

```
en-enter;1625333857740
en-start;1625333858632
de-enter;1625399796756
de-start;1625399797504
de-result;1625399970330
```

Each line in this file is called an *entry*. An entry has the following syntax:

```
{prefix}{checkpoint ID};{timestamp}\n
```

- `prefix`: identifier of the Vote-O-Mat instance which sent the entry *(Default: empty string)*
- `checkpoint ID`: identifier of the checkpoint which was accessed. *(Default: 'enter', 'start', or 'result')*
- `timestamp`: UNIX timestamp in milliseconds

### Custom Checkpoint IDs

By default, the checkpoint IDs are the same as the checkpoints: *enter*, *start*, and *result*. If these IDs do not suit you, you can customize the used ID for each checkpoint.

- Open `setup.html` to customize the checkpoint IDs.
- Forward to the statistics settings.
- Enter custom checkpoint IDs for checkpoints as you like. Leave a field empty to use the respective default ID.

**Attention:** With great power comes great responsibility. Vote-O-Mat does not verify your checkpoint ID. Make sure it does not contain any malicious characters, like `;`, which would interfere with the logging format above. You probably also want all IDs to be distinct.

### Custom Checkpoint Prefixes

In theory, the checkpoint prefixes are thought to classify data by the Vote-O-Mat language. In practice, you could group Vote-O-Mat instances as you like.

- Open `setup.html` to create groups.
- Advance to the statistics settings.
- Uncollapse the panel on language prefixes at the bottom of the page.
- Add a language prefix for every group. You are free in the naming of the groups and their prefixes.

**Attention:** Again, you are responsible for breaking stuff, as Vote-O-Mat does not verify your groups. Malicious characters like `;` will not be filtered, indistinct group prefixes will render the groups useless.

For each Vote-O-Mat instance:

- Open `generator.html` to assign the instance to a group.
- Advance to the statistics settings.
- Select the desired group. If you assign no group to an instance, it uses an empty string as prefix.
- You can also assign multiple Vote-O-Mat instances to the same group.

**Attention:** The group assignment saves the group's name and the group's prefix directly in the configuration of the Vote-O-Mat instance. If you change the group prefix in `config/setup.json`, this change will not have an effect on already configured instances, but every future configuration of a Vote-O-Mat instance.

### Custom Log File Name and Location

The log file is called `hits.log` and located in the directory of the statistics module, `vom-statistics`. You can change both of that.

- Open `setup.html` to customize the log file location and name.
- Advance to the statistics settings.
- Uncollapse the panel on advanced settings at the bottom of the page.
- Enter a path for the log file. The path is relative to the directory of the statistics module, `vom-statistics`.

**Note:** Vote-O-Mat creates the log file if it does not exist. Yet, Vote-O-Mat does not create any folders on the *path to* the log file. Make sure the directory in which to put the log file already exists, otherwise logging will fail.

**Example A:** The log file path `../statistics.csv` will create a log file named `statistics.csv` in the root directory (supposed `vom-statistics` is located in the root directory).

**Example B:** The log file path `test/statistics.log` will create a log file named `statistics.log` in a folder `test` located in `vom-statistics`. This will break if you did not create folder `test` before.

**Attention:** As usual, Vote-O-Mat does not prevent you from doing dumb stuff. If you enter a malicious path, the logging will break.

### <a name="StatisticsDashboard"></a>Custom Statistics Module URL

You can access the dashboard of the statistics module via `https://example.com/vom-statistics/`, supposed you published the Vote-O-Mat at `https://example.com`.

Here is how you can change that URL:

- Supposed you want to access the statistics dashboard at `https://example.com/stats/`.
- Rename the folder `vom-statistics` to `stats`.
- Open `setup.html` to change the statistics module URL.
- Advance to the statistics settings.
- Uncollapse the panel on advanced settings at the bottom of the page.
- Enter `stats`, the new name of the folder (former `vom-statistics`).
    - *For techies:* you can enter any path relative to the root directory or a complete URL.

**Attention (for techies):** This feature enables you to move the complete statistics module to another location, like another server. For whatever reason you possibly would want to that: notice, that the module expects the `setup.json` to be located at `../config/setup.json`, relative to the statistics module's directory.

# <a name="troubleshooting"></a>Troubleshooting

### I keep klicking on the Start! button, but nothing happens

Mahlowat could not load the config file. Make sure it exists, is readable by the web server (you could try to access it directly 
with your browser at https://example.com/config/data.json) and syntactically correct.

### Everything says weird stuff like btn-start or start-explanatory-text. Also, nothing works.

Looks like the JavaScript part is broken. Did you include exactly one language file (see above)? It might also contain a syntax error.

### The results are empty

You should give your opinion on at least one thesis.

### I open mahlowat and I only get a red warning box, but it does not work!

Did you open the `index.html` file directly in your web browser? That unfortunately does not work in most browsers. Try uploading everything
to a web server and opening it from there instead. Or run a web server locally for development.

If you did in fact access it from a web server, do as the error message says: Does the file exist? Can you access it with your web browser
directly or do you get an error message? And lastly, does it not contain syntax errors?


# Weal and Woe
### I cannot get the Vote-O-Mat up and running

A pity! Check out [Troubleshooting](#troubleshooting). If this does not work, ask a friend. If this person also cannot help, [open an issue](https://github.com/SilvanVerhoeven/vote-o-mat/issues) (and hope it gets noticed).

### I want to report a bug

Great! [Open an issue](https://github.com/SilvanVerhoeven/vote-o-mat/issues) (and hope it gets noticed).

### I want to fix a bug

Great! [Issue a pull request](https://github.com/SilvanVerhoeven/vote-o-mat/pulls) (and hope it gets noticed).

### I want to complain / say thanks

I am always happy to receive success stories (or stories of failure for that matter) at silvan.verhoeven@student.hpi.de
