(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[21],{

/***/ "./node_modules/monaco-editor/esm/vs/basic-languages/html/html.js":
/*!************************************************************************!*\
  !*** ./node_modules/monaco-editor/esm/vs/basic-languages/html/html.js ***!
  \************************************************************************/
/*! exports provided: conf, language */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"conf\", function() { return conf; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"language\", function() { return language; });\n/*---------------------------------------------------------------------------------------------\r\n *  Copyright (c) Microsoft Corporation. All rights reserved.\r\n *  Licensed under the MIT License. See License.txt in the project root for license information.\r\n *--------------------------------------------------------------------------------------------*/\r\n\r\n// Allow for running under nodejs/requirejs in tests\r\nvar _monaco = (typeof monaco === 'undefined' ? self.monaco : monaco);\r\nvar EMPTY_ELEMENTS = ['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'keygen', 'link', 'menuitem', 'meta', 'param', 'source', 'track', 'wbr'];\r\nvar conf = {\r\n    wordPattern: /(-?\\d*\\.\\d\\w*)|([^\\`\\~\\!\\@\\$\\^\\&\\*\\(\\)\\=\\+\\[\\{\\]\\}\\\\\\|\\;\\:\\'\\\"\\,\\.\\<\\>\\/\\s]+)/g,\r\n    comments: {\r\n        blockComment: ['<!--', '-->']\r\n    },\r\n    brackets: [\r\n        ['<!--', '-->'],\r\n        ['<', '>'],\r\n        ['{', '}'],\r\n        ['(', ')']\r\n    ],\r\n    autoClosingPairs: [\r\n        { open: '{', close: '}' },\r\n        { open: '[', close: ']' },\r\n        { open: '(', close: ')' },\r\n        { open: '\"', close: '\"' },\r\n        { open: '\\'', close: '\\'' }\r\n    ],\r\n    surroundingPairs: [\r\n        { open: '\"', close: '\"' },\r\n        { open: '\\'', close: '\\'' },\r\n        { open: '{', close: '}' },\r\n        { open: '[', close: ']' },\r\n        { open: '(', close: ')' },\r\n        { open: '<', close: '>' },\r\n    ],\r\n    onEnterRules: [\r\n        {\r\n            beforeText: new RegExp(\"<(?!(?:\" + EMPTY_ELEMENTS.join('|') + \"))([_:\\\\w][_:\\\\w-.\\\\d]*)([^/>]*(?!/)>)[^<]*$\", 'i'),\r\n            afterText: /^<\\/([_:\\w][_:\\w-.\\d]*)\\s*>$/i,\r\n            action: { indentAction: _monaco.languages.IndentAction.IndentOutdent }\r\n        },\r\n        {\r\n            beforeText: new RegExp(\"<(?!(?:\" + EMPTY_ELEMENTS.join('|') + \"))(\\\\w[\\\\w\\\\d]*)([^/>]*(?!/)>)[^<]*$\", 'i'),\r\n            action: { indentAction: _monaco.languages.IndentAction.Indent }\r\n        }\r\n    ],\r\n    folding: {\r\n        markers: {\r\n            start: new RegExp(\"^\\\\s*<!--\\\\s*#region\\\\b.*-->\"),\r\n            end: new RegExp(\"^\\\\s*<!--\\\\s*#endregion\\\\b.*-->\")\r\n        }\r\n    }\r\n};\r\nvar language = {\r\n    defaultToken: '',\r\n    tokenPostfix: '.html',\r\n    ignoreCase: true,\r\n    // The main tokenizer for our languages\r\n    tokenizer: {\r\n        root: [\r\n            [/<!DOCTYPE/, 'metatag', '@doctype'],\r\n            [/<!--/, 'comment', '@comment'],\r\n            [/(<)((?:[\\w\\-]+:)?[\\w\\-]+)(\\s*)(\\/>)/, ['delimiter', 'tag', '', 'delimiter']],\r\n            [/(<)(script)/, ['delimiter', { token: 'tag', next: '@script' }]],\r\n            [/(<)(style)/, ['delimiter', { token: 'tag', next: '@style' }]],\r\n            [/(<)((?:[\\w\\-]+:)?[\\w\\-]+)/, ['delimiter', { token: 'tag', next: '@otherTag' }]],\r\n            [/(<\\/)((?:[\\w\\-]+:)?[\\w\\-]+)/, ['delimiter', { token: 'tag', next: '@otherTag' }]],\r\n            [/</, 'delimiter'],\r\n            [/[^<]+/],\r\n        ],\r\n        doctype: [\r\n            [/[^>]+/, 'metatag.content'],\r\n            [/>/, 'metatag', '@pop'],\r\n        ],\r\n        comment: [\r\n            [/-->/, 'comment', '@pop'],\r\n            [/[^-]+/, 'comment.content'],\r\n            [/./, 'comment.content']\r\n        ],\r\n        otherTag: [\r\n            [/\\/?>/, 'delimiter', '@pop'],\r\n            [/\"([^\"]*)\"/, 'attribute.value'],\r\n            [/'([^']*)'/, 'attribute.value'],\r\n            [/[\\w\\-]+/, 'attribute.name'],\r\n            [/=/, 'delimiter'],\r\n            [/[ \\t\\r\\n]+/],\r\n        ],\r\n        // -- BEGIN <script> tags handling\r\n        // After <script\r\n        script: [\r\n            [/type/, 'attribute.name', '@scriptAfterType'],\r\n            [/\"([^\"]*)\"/, 'attribute.value'],\r\n            [/'([^']*)'/, 'attribute.value'],\r\n            [/[\\w\\-]+/, 'attribute.name'],\r\n            [/=/, 'delimiter'],\r\n            [/>/, { token: 'delimiter', next: '@scriptEmbedded', nextEmbedded: 'text/javascript' }],\r\n            [/[ \\t\\r\\n]+/],\r\n            [/(<\\/)(script\\s*)(>)/, ['delimiter', 'tag', { token: 'delimiter', next: '@pop' }]]\r\n        ],\r\n        // After <script ... type\r\n        scriptAfterType: [\r\n            [/=/, 'delimiter', '@scriptAfterTypeEquals'],\r\n            [/>/, { token: 'delimiter', next: '@scriptEmbedded', nextEmbedded: 'text/javascript' }],\r\n            [/[ \\t\\r\\n]+/],\r\n            [/<\\/script\\s*>/, { token: '@rematch', next: '@pop' }]\r\n        ],\r\n        // After <script ... type =\r\n        scriptAfterTypeEquals: [\r\n            [/\"([^\"]*)\"/, { token: 'attribute.value', switchTo: '@scriptWithCustomType.$1' }],\r\n            [/'([^']*)'/, { token: 'attribute.value', switchTo: '@scriptWithCustomType.$1' }],\r\n            [/>/, { token: 'delimiter', next: '@scriptEmbedded', nextEmbedded: 'text/javascript' }],\r\n            [/[ \\t\\r\\n]+/],\r\n            [/<\\/script\\s*>/, { token: '@rematch', next: '@pop' }]\r\n        ],\r\n        // After <script ... type = $S2\r\n        scriptWithCustomType: [\r\n            [/>/, { token: 'delimiter', next: '@scriptEmbedded.$S2', nextEmbedded: '$S2' }],\r\n            [/\"([^\"]*)\"/, 'attribute.value'],\r\n            [/'([^']*)'/, 'attribute.value'],\r\n            [/[\\w\\-]+/, 'attribute.name'],\r\n            [/=/, 'delimiter'],\r\n            [/[ \\t\\r\\n]+/],\r\n            [/<\\/script\\s*>/, { token: '@rematch', next: '@pop' }]\r\n        ],\r\n        scriptEmbedded: [\r\n            [/<\\/script/, { token: '@rematch', next: '@pop', nextEmbedded: '@pop' }],\r\n            [/[^<]+/, '']\r\n        ],\r\n        // -- END <script> tags handling\r\n        // -- BEGIN <style> tags handling\r\n        // After <style\r\n        style: [\r\n            [/type/, 'attribute.name', '@styleAfterType'],\r\n            [/\"([^\"]*)\"/, 'attribute.value'],\r\n            [/'([^']*)'/, 'attribute.value'],\r\n            [/[\\w\\-]+/, 'attribute.name'],\r\n            [/=/, 'delimiter'],\r\n            [/>/, { token: 'delimiter', next: '@styleEmbedded', nextEmbedded: 'text/css' }],\r\n            [/[ \\t\\r\\n]+/],\r\n            [/(<\\/)(style\\s*)(>)/, ['delimiter', 'tag', { token: 'delimiter', next: '@pop' }]]\r\n        ],\r\n        // After <style ... type\r\n        styleAfterType: [\r\n            [/=/, 'delimiter', '@styleAfterTypeEquals'],\r\n            [/>/, { token: 'delimiter', next: '@styleEmbedded', nextEmbedded: 'text/css' }],\r\n            [/[ \\t\\r\\n]+/],\r\n            [/<\\/style\\s*>/, { token: '@rematch', next: '@pop' }]\r\n        ],\r\n        // After <style ... type =\r\n        styleAfterTypeEquals: [\r\n            [/\"([^\"]*)\"/, { token: 'attribute.value', switchTo: '@styleWithCustomType.$1' }],\r\n            [/'([^']*)'/, { token: 'attribute.value', switchTo: '@styleWithCustomType.$1' }],\r\n            [/>/, { token: 'delimiter', next: '@styleEmbedded', nextEmbedded: 'text/css' }],\r\n            [/[ \\t\\r\\n]+/],\r\n            [/<\\/style\\s*>/, { token: '@rematch', next: '@pop' }]\r\n        ],\r\n        // After <style ... type = $S2\r\n        styleWithCustomType: [\r\n            [/>/, { token: 'delimiter', next: '@styleEmbedded.$S2', nextEmbedded: '$S2' }],\r\n            [/\"([^\"]*)\"/, 'attribute.value'],\r\n            [/'([^']*)'/, 'attribute.value'],\r\n            [/[\\w\\-]+/, 'attribute.name'],\r\n            [/=/, 'delimiter'],\r\n            [/[ \\t\\r\\n]+/],\r\n            [/<\\/style\\s*>/, { token: '@rematch', next: '@pop' }]\r\n        ],\r\n        styleEmbedded: [\r\n            [/<\\/style/, { token: '@rematch', next: '@pop', nextEmbedded: '@pop' }],\r\n            [/[^<]+/, '']\r\n        ],\r\n    },\r\n};\r\n\n\n//# sourceURL=webpack:///./node_modules/monaco-editor/esm/vs/basic-languages/html/html.js?");

/***/ })

}]);