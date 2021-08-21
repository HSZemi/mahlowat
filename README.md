![Mahlowat](img/mahlowat_logo.png)

[Deutsche Version](README-DE.md)

Vote-O-Mat is a more feature-rich implementation of the voting advice application [mahlowat](https://github.com/HSZemi/mahlowat). Both allow users to compare their opinion on selected theses to the opinions of groups or individuals competing in an election.

Vote-O-Mat makes it easier to offer *mahlowat* in multiple languages, adjust its appearance to a brand, and can offer anonymous usage statistics ([see privacy-related information](#privacy)). If you do not need any of these features, you are probably better off using [mahlowat](https://github.com/HSZemi/mahlowat).


# General Approach

There will be an election at some point in the future. A team of highly skilled individuals devises a list of simple theses which 
can be answered with Yes or No.

Once the groups or candidates participating in the election are set, they are being sent the theses and asked to provide a positioning 
(Yes/No/Neutral) and a short statement for each thesis.

Some poor souls will then compile all responses into one configuration file for each language (see below).

The Vote-O-Mat is consequently configured, published and advertised.

Enjoy!


# Getting Started

A Vote-O-Mat is structured into:

- The **Vote-O-Mat** itself, which provides a landing page with all available languages. The Vote-O-Mat contains
- One or more **Vote-O-Mat instances** (`vom-instance`), one instance for every available language and
- a **statistics module** (`vom-statistics`), responsible for creating and displaying the anonymous usage statistics

In order to get Vote-O-Mat up and running, you have to do three things:

 - Create a general *setup file* which contains settings for branding, information on the available Vote-O-Mat languages and statistics configurations
 - Create one Vote-O-Mat instance for each language
 - Upload all files to a web server where everyone can see them :eyes:

 **Note:** The setup might be easier if all files are uploaded to the server first, prior to the configuration. Still, both orders are possible.

Outline of the Vote-O-Mat's directory with the most important files (used for reference in future):

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

## General Setup

First, open the setup tool `setup.html` in the root directory. It takes you through all settings needed for the setup.

During setup, you need to fill in links to the individual Vote-O-Mat instances. If you do not know them yet, leave them blank for now and fill them in after setting everything else up.

At the end, the setup tool generates a cryptic text, which you need to copy into `config/setup.json`. If the file does not exist in the `config` directory, simply create it. Make sure the file is saved as `UTF-8` encoding.

If you later need to make changes to `config/setup.json`, just open `setup.html` again. It loads all data from an existing `config/setup.json`, so you do not have to start from scratch.

***Sidenote**: if the `config/setup.json` cannot be loaded, i.e. because you are working locally on your PC, the setup tool will prompt you a text field on the first page as a workaround. Manually copy the content of an existing `config.setup.json` into this field to make changes to it.*

## Create Instances

We now need to create the actual Vote-O-Mat instances, one for each language.

In the root directory, create as many Vote-O-Mat instances as you need by copying the template directory `vom-instance` (you can also use the template directory itself as an instance).

Repeat the following process for each instance.

- Rename the instance's directory (not the root directory) to suit the anticipated language. Like `en` if it contains the English Vote-O-Mat instance.
- Open the configuration tool `generator.html`, located inside the instance's directory. Here, you need to add all theses, electable groups or candidates, and their answers.
- Copy and save the text created by the configuration tool in `config/data.json`, located inside the instance's directory. Again, create the file if it does not yet exist, save it using `UTF-8` encoding, you know the drill.
- Finally, we need to set the display language (e.g. button captions). Learn how to do that [here](#DisplayLanguage).

I bet you already guessed it, but for completeness: like the setup tool, the configuration tool also loads existing `config/data.json` files so you can easily make changes to the file. If this is not possible, it again prompts you text ... fields? Yes, text field**s**! One for entering `../config/setup.json` (from the `config` in the root directory) and one for the instance's `config/data.json`.

## Publishing

Upload the content of the root directory, namely the folders `config`, `css`, `img`, `js`, `lang`, the file `index.html`, the folders of all Vote-O-Mat instances and – if the statistics module is used – the folder `vom-statistics` onto the web server of your choice.

Done!

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
<script src="lang/fr_fr.js"></script>
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

## Statistics on Steroids

- About how the collected data can be customized

## <a name="privacy"></a>Some Words on Privacy

You may ask

> Statistics in an election-related software? But what about privacy!?

If you do not, you should. Privacy is always important, even more in this context. That is why Vote-O-Mat only collects a minimum of data, all anonymous.

### How does the data collection work?

The Vote-O-Mat contains predefined *checkpoints*. These are specific actions within the application. Checkpoints are:

- *enter*: the intro page of a Vote-O-Mat instance is displayed
- *start*: the start button on the intro page was clicked, now displaying the first thesis
- *result* the results are displayed

Each checkpoint can be activated separately. Only then it is part of the collected data. By default, all checkpoints are disabled, thus no data is collected, and no statistics are available.

Every time an activated checkpoint is entered, the Vote-O-Mat instance sends the checkpoint ID (*enter*, *start*, or *result*, or a custom name for these) to the statistics module. The ID can be preceeded by a prefix like *de-* which can be set for each Vote-O-Mat instance and makes it possible to differentiate usages between languages.

The statistic module logs every incoming checkpoint ID (and prefix) together with a timestamp in a [CSV](https://en.wikipedia.org/wiki/Comma-separated_values)-file. This looks like follows:

```
de-enter;1625303227182
de-start;1625303229297
en-enter;1625333857740
en-start;1625333858632
en-result;1625334140898
en-enter;1625378574483
de-enter;1625399796756
de-start;1625399797504
de-result;1625399970330
de-enter;1625424414587
de-start;1625424415378
```

Apparently, the statistic module does not log any personal information.

### How is the collected data protected?

It is not. As the retrieved data does not contain any personal information, a protection of the data has no priority. That is why the log file is not encrypted and why the log file and the statistic dashboard have no password protection.

That being said, feel free to add these features!

### What evaluations are done on the data?

The statistics dashboard of Vote-O-Mat has two features: a table showing how often which checkpoint was passed in which Vote-O-Mat instance (i.e. in which language) and a chart showing the numbers of checkpoint passes over time, separated by checkpoint and Vote-O-Mat instance.

With these tools, questions like the following may be answered:

- How many people have used the Vote-O-Mat?
- Is the effort (for a particular instance) worth it?
- Do visitors actually finish the Vote-O-Mat?
- Which advertising means have significant impact? (Supposed they are published at different times, so certain spikes can be attributed to a particular mean)

Of course, using the raw data, more sophisticated analyses are possible. One could try to estimate the average duration users need to absolve the Vote-O-Mat. Or evaluate which advertising mean generates users which actually absolve the Vote-O-Mat. In the end, it is up to the analysts what can be read out of the data.

# Troubleshooting

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

### I want to report a bug

Great! [Open an issue](https://github.com/HSZemi/mahlowat/issues) (and hope it gets noticed).

### I want to fix a bug

Great! [Issue a pull request](https://github.com/HSZemi/mahlowat/pulls) (and hope it gets noticed).

### I want to complain / say thanks

I am always happy to receive success stories (or stories of failure for that matter) at mahlowat@hszemi.de
