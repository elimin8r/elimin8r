![Elimin8r](https://elimin8r.com/elimin8r-logo.svg)

`Elimin8r` is an free WordPress starter theme that utilzes Vite as a build tool.

## Getting started

Elimin8r has been tested with WordPress version 6.6+. Any version’s below this may result in Elimin8r not working as intended.

The theme uses Vite to compress images, minify JavaScript and compile Sass stylesheets. You will therefore need to ensure you have the following tools installed:

- [Node.js (v21+)](https://nodejs.org/)

### Setup

To start using the build tools that come with Elimin8r, you need to install the necessary dependencies. Run the following command in the root of the Elimin8r theme directory:

`$ npm install`

### Build commands

Elimin8r comes with the following commands for building assets:

**Watch for asset changes**

`$ npm run watch`

**Build assets**

`$ npm run build`

### Asset directories

All of the raw, uncompressed assets are located in the theme’s **/resources** directory.

Upon running the build tool, all assets in the **/resources** directory will be compressed and placed into the theme’s **/public** directory.

### Want to know more? [View the docs](https://elimin8r.test/docs/).