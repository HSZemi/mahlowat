![Mahlowat](img/mahlowat_logo.png)

[Deutsche Version](README-DE.md)

Mahlowat is an implementation of a voting advice application (VAA). It allows users to compare their opinion on selected theses
to the opinions of groups or individuals competing in an election.


General Approach
----------------

There will be an election at some point in the future. A team of highly skilled individuals devises a list of simple theses which 
can be answered with Yes or No.

Once the groups or candidates participating in the election are set, they are being sent the theses and asked to provide a positioning 
(Yes/No/Neutral) and a short statement for each thesis.

One poor soul will then compile all responses into a configuration file (see below).

A Mahlowat instance is consequently configured, published and advertised. 

Enjoy!


Setup
-----

In order to get Mahlowat up and running, you have to do three things:

 - Create a configuration file which contains all the theses and responses of the participating groups
 - Select a language and adapt the application texts
 - Upload the files to a web server where everyone can see them :see_no_evil:

### Configuration

Mahlowat uses a single file, `config/data.json`, which contains the theses, information about the groups, and the groups' 
responses and statements.

You should probably use `generator.html` to generate this configuration file. It will load the data from an existing 
`config/data.json`, so you won't have to start all over again if you want to correct or add something.

At the end of a three step process, the generator yields the contents to the `config/data.json` file, which you will
have to enter there manually (please copy-paste). Make sure the file is saved with the `UTF-8` encoding.

### Language

Mahlowat comes with three languages: German (de\_de, default), English (en\_gb) and French (fr\_fr).

If you want to change the display language, you have to do a tiny edit in `index.html`.
Go to the very bottom, where you will find this section:

```
<!-- Select (uncomment) exactly one of the following languages-->
<script src="lang/de_de.js"></script>
<!-- <script src="lang/en_gb.js"></script> -->
<!-- <script src="lang/fr_fr.js"></script> -->
<!-- end languages-->
```

To change the active language, comment out the currently active language (comment out = enclose the whole line in `<!--` and `-->`)
and uncomment the language of your choice (removing the `<!--` and `-->`). Example: If you want to run Mahlowat in french, it should
look like this:

```
<!-- Select (uncomment) exactly one of the following languages-->
<!-- <script src="lang/de_de.js"></script> -->
<!-- <script src="lang/en_gb.js"></script> -->
<script src="lang/fr_fr.js"></script>
<!-- end languages-->
```

You may also want to change some of the text, especially the Q&A part. In order to do that, directly edit the language `*.js` files
which you can find in the `lang` subfolder. 

You can use html tags inside of the strings. Just make sure to not introduce errors in the JavaScript, because that will unfortunately
break the whole application. If you are unsure, maybe ask a friend for help.

**Attention!** In order to support Internet Explorer 11 (lol), [babel](https://babeljs.io) has been used to transpile the 
language files from a raw version (e.g. `en_gb.raw.js`) into the production version (e.g. `en_gb.js`).
You can edit the "raw" files and then do that yourself – or edit the transpiled versions directly.

```
npm install --save-dev @babel/core @babel/cli @babel/preset-env @babel/node
babel --presets @babel/preset-env lang/de_de.raw.js > lang/de_de.js
babel --presets @babel/preset-env lang/en_gb.raw.js > lang/en_gb.js
babel --presets @babel/preset-env lang/fr_fr.raw.js > lang/fr_fr.js
```

#### Multiple languages

You might want to offer the Mahlowat in multiple languages at once, for example in French and German.

We recommend creating multiple instances, which means you would send the groups or candidates the theses in French and in German and ask for 
positioning and statements in both languages. You would then create two separate Mahlowat instances, one in French with the french content (available under https://example.com/fr), one in German with the german content (available under https://example.com/de). You could add a landing page which links
to the two versions.

### Publish

Upload the `config`, `css`, `img`, `js`, and `lang` folders with their contents as well as the `index.html` file to a directory on 
the web server of your choice.

Done!


Calculations
------------

The points for the groups in the results at the end are calculated as follows: 

 - The user's answers are compared to each group's answers.
 - The group gains 2 points for each thesis where their answer matches the user's.
 - A slight deviation (yes/neutral or neutral/no) gains the group still 1 point.
 - If the answers are contrary or if a group has no position on a thesis, the group gains no point.
 - A thesis that the user skipped gains no one any point. The maximum number of points possible decreases.
 - A thesis that the user counts double gets groups twice the points (0/2/4). This increases the maximum number of points possible.


Demo
----

[Deutsch :de:](https://hscmi.de/mahlowat/de/) [English :uk:](https://hscmi.de/mahlowat/en/) [Français :fr:](https://hscmi.de/mahlowat/fr/)


Troubleshooting
---------------

#### I keep klicking on the Start! button, but nothing happens

Mahlowat could not load the config file. Make sure it exists, is readable by the web server (you could try to access it directly 
with your browser at https://example.com/config/data.json) and syntactically correct.


#### Everything says weird stuff like btn-start or start-explanatory-text. Also, nothing works.

Looks like the JavaScript part is broken. Did you include exactly one language file (see above)? It might also contain a syntax error.


#### The results are empty

You should give your opinion on at least one thesis.


#### I open mahlowat and I only get a red warning box, but it does not work!

Did you open the `index.html` file directly in your web browser? That unfortunately does not work in most browsers. Try uploading everything
to a web server and opening it from there instead. Or run a web server locally for development.

If you did in fact access it from a web server, do as the error message says: Does the file exist? Can you access it with your web browser
directly or do you get an error message? And lastly, does it not contain syntax errors?


Weal and Woe
------------

#### I want to report a bug

Great! [Open an issue](https://github.com/HSZemi/mahlowat/issues) (and hope it gets noticed).

#### I wang to fix a bug

Great! [Issue a pull request](https://github.com/HSZemi/mahlowat/pulls) (and hope it gets noticed).

#### I want to complain / say thanks

I am always happy to receive success stories (or stories of failure for that matter) at mahlowat@hszemi.de
