const path = require('path');
const MonacoWebpackPlugin = require('monaco-editor-webpack-plugin');

module.exports = {
    mode: "production",

    resolve: {
        extensions: ["*", ".ts", ".tsx", ".js", ".mjs", ".css", ".ttf"]
    },

    module: {
        rules: [
            {
                test: /\.worker\.js$/,
                use: {
                    loader: 'worker-loader',
                    options: {inline: true}
                },
            },
            {
                test: /\.mjs$/,
                include: /node_modules/,
                type: 'javascript/auto'
            },
            {
                test: /\.css$/i,
                use: ['style-loader', 'css-loader'],
            },
            {
                test: /\.ttf$/,
                use: ['file-loader']
            },
            {
                test: /\.ts(x?)$/,
                exclude: /node_modules/,
                use: [
                    {
                        loader: "ts-loader"
                    }
                ]
            }
        ]
    },
    plugins: [
        new MonacoWebpackPlugin({
            languages: ['markdown'],
        })
    ],
    entry: './src/index.tsx',
    output: {
        path: path.resolve(__dirname, 'assets'),
        filename: 'graphqlschemaeditor.js'
    }
};