const path = require('path');
const fs = require('fs');
const MiniCssExtractPlugin   = require('mini-css-extract-plugin');
const TerserPlugin           = require('terser-webpack-plugin');
const CssMinimizerPlugin     = require('css-minimizer-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const ImageMinimizerPlugin   = require("image-minimizer-webpack-plugin");
const FontminPlugin      = require('fontmin-webpack');
const SoundsPlugin       = require('sounds-webpack-plugin')

// Global Directories
const JS_DIR = path.resolve(__dirname, 'js');
const BUILD_DIR = path.resolve(__dirname, '../dist');

const BLOCKS_JS_PATH = fs.readdirSync('js/blocks').reduce((entries, file) => {
    const FILE_NAME = file.replace(/\.[^/.]+$/, '');
    const jsFilePath = `./js/blocks/${FILE_NAME}.js`;
    const scssFilePath = `./scss/blocks/${FILE_NAME}.scss`;

    if (fs.existsSync(scssFilePath) && fs.existsSync(jsFilePath)) {
        entries[`blocks/${FILE_NAME}`] = [scssFilePath, jsFilePath];
    } else if (fs.existsSync(jsFilePath)) {
        // Check if jsFilePath is an array, if not, add the prefix
        entries[`../js/blocks/${FILE_NAME}`] = Array.isArray(jsFilePath) ? jsFilePath : `./js/blocks/${FILE_NAME}.js`;
    }
    return entries;
}, {});


const BLOCKS_SCSS_PATH = fs.readdirSync('scss/blocks').reduce((entries, file) => {
    const FILE_NAME = file.replace(/\.[^/.]+$/, '');
    const scssFilePath = `./scss/blocks/${FILE_NAME}.scss`;
    const jsFilePath = `./js/blocks/${FILE_NAME}.js`;

    if (fs.existsSync(scssFilePath) && fs.existsSync(jsFilePath)) {
        entries[`blocks/${FILE_NAME}`] = [scssFilePath, jsFilePath];
    } else if (!fs.existsSync(jsFilePath) && fs.existsSync(scssFilePath)) {
        entries[`../css/blocks/${FILE_NAME}`] = scssFilePath;
    }

    return entries;
}, {});




// Output files

const entry = {
    main: ['./scss/main.scss', './js/main.js'],
    ...BLOCKS_JS_PATH,
    ...BLOCKS_SCSS_PATH,
};
console.log(entry)


// Output files
const output = {
    path: BUILD_DIR,
    filename: './js/[name].min.js',
};

// Webpack Rules Config
const rules = [
    {
        test: /\.js$/,
        include: [JS_DIR],
        exclude: /node_modules/,
        use: [
            {
                loader: 'babel-loader',
                options: {
                    presets: ['@babel/preset-env'],
                },
            },
            {
                loader: 'eslint-loader',
            },
        ],
    },
    {
        test: /\.css$/,
        use: [
            MiniCssExtractPlugin.loader,
            //'style-loader', // creates style nodes from JS strings

            {
                loader: 'css-loader',
                options: {
                    sourceMap: false,
                },
            }
        ]
    },
    {
        test: /\.scss$/,
        exclude: /node_modules/,
        use: [
            MiniCssExtractPlugin.loader,
            {
                loader: 'css-loader',
            },
            {
                loader: 'postcss-loader',
                options: {
                    postcssOptions: {
                        plugins: [
                            [
                                'autoprefixer',
                            ],
                        ],
                    },
                },
            },

            {
                loader: 'sass-loader',
            }
        ]
    },
    {
        test: /\.(jpe?g|png|gif|svg)$/i,
        type: "asset",
        generator: {
            filename: 'images/pr-optimized-[name][ext]'
        }
    },
    {
        test: /\.(ttf|otf|woff|woff2)$/,
        type: 'asset',
        generator: {
            filename: 'fonts/[name][ext][query]'
        }
    },


];
const plugins = (argv) => [
    // new SoundsPlugin({
    //     sounds: {
    //         customSound: path.join(__dirname,   '/sounds/error.mp3'),
    //         customWarning: path.join(__dirname, '/sounds/warn.mp3'),
    //         customSuccess: path.join(__dirname, '/sounds/ok.mp3'),
    //     },
    //     notifications: {
    //         done(stats) {
    //             if (stats.hasErrors()) {
    //                 this.play('customSound')
    //             } else if (stats.hasWarnings()) {
    //                 this.play('customWarning')
    //             } else {
    //                 this.play('customSuccess')
    //             }
    //         },
    //     },
    // }),
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({
        filename: 'css/[name].min.css',
    }),
];
module.exports = (env, argv) => ({
    entry,
    output,
    devtool: false, //source-map
    module: {
        rules,
    },
    optimization: {
        splitChunks: {
            cacheGroups: {
                styles: {
                    test: /\.scss$/,
                    enforce: true,
                },
            },
        },
        minimizer: [
            new CssMinimizerPlugin(),
            new TerserPlugin(),
            new ImageMinimizerPlugin({
                loader: true,
                deleteOriginalAssets: false,
                minimizer: {
                    implementation: ImageMinimizerPlugin.imageminMinify,
                    options: {
                        plugins: [
                            "imagemin-gifsicle",
                            "imagemin-mozjpeg",
                            "imagemin-pngquant",
                            "imagemin-svgo",
                        ],
                    },
                },
            }),
            new FontminPlugin({
                autodetect: true,
                extract: {
                    plugin: [
                        'ttf2woff2', // Convert TTF to WOFF2
                        'ttf2woff' // Convert TTF to WOFF
                    ]
                }
            })

        ],
    },
    plugins: plugins(argv),
});