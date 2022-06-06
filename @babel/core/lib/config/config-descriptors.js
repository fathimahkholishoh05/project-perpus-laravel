"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.createCachedDescriptors = createCachedDescriptors;
exports.createDescriptor = createDescriptor;
exports.createUncachedDescriptors = createUncachedDescriptors;

function _gensync() {
  const data = require("gensync");

  _gensync = function () {
    return data;
  };

  return data;
}

var _files = require("./files");

var _item = require("./item");

var _caching = require("./caching");

var _resolveTargets = require("./resolve-targets");

function isEqualDescriptor(a, b) {
  return a.name === b.name && a.value === b.value && a.options === b.options && a.dirname === b.dirname && a.alias === b.alias && a.ownPass === b.ownPass && (a.file && a.file.request) === (b.file && b.file.request) && (a.file && a.file.resolved) === (b.file && b.file.resolved);
}

function* handlerOf(value) {
  return value;
}

function optionsWithResolvedBrowserslistConfigFile(options, dirname) {
  if (typeof options.browserslistConfigFile === "string") {
    options.browserslistConfigFile = (0, _resolveTargets.resolveBrowserslistConfigFile)(options.browserslistConfigFile, dirname);
  }

  return options;
}

function createCachedDescriptors(dirname, options, alias) {
  const {
    plugins,
    presets,
    passPerPreset
  } = options;
  return {
    options: optionsWithResolvedBrowserslistConfigFile(options, dirname),
    plugins: plugins ? () => createCachedPluginDescriptors(plugins, dirname)(alias) : () => handlerOf([]),
    presets: presets ? () => createCachedPresetDescriptors(presets, dirname)(alias)(!!passPerPreset) : () => handlerOf([])
  };
}

function createUncachedDescriptors(dirname, options, alias) {
  let plugins;
  let presets;
  return {
    options: optionsWithResolvedBrowserslistConfigFile(options, dirname),

    *plugins() {
      if (!plugins) {
        plugins = yield* createPluginDescriptors(options.plugins || [], dirname, alias);
      }

      return plugins;
    },

    *presets() {
      if (!presets) {
        presets = yield* createPresetDescriptors(options.presets || [], dirname, alias, !!options.passPerPreset);
      }

      return presets;
    }

  };
}

const PRESET_DESCRIPTOR_CACHE = new WeakMap();
const createCachedPresetDescriptors = (0, _caching.makeWeakCacheSync)((items, cache) => {
  const dirname = cache.using(dir => dir);
  return (0, _caching.makeStrongCacheSync)(alias => (0, _caching.makeStrongCache)(function* (passPerPreset) {
    const descriptors = yield* createPresetDescriptors(items, dirname, alias, passPerPreset);
    return descriptors.map(desc => loadCachedDescriptor(PRESET_DESCRIPTOR_CACHE, desc));
  }));
});
const PLUGIN_DESCRIPTOR_CACHE = new WeakMap();
const createCachedPluginDescriptors = (0, _caching.makeWeakCacheSync)((items, cache) => {
  const dirname = cache.using(dir => dir);
  return (0, _caching.makeStrongCache)(function* (alias) {
    const descriptors = yield* createPluginDescriptors(items, dirname, alias);
    return descriptors.map(desc => loadCachedDescriptor(PLUGIN_DESCRIPTOR_CACHE, desc));
  });
});
const DEFAULT_OPTIONS = {};

function loadCachedDescriptor(cache, desc) {
  const {
    value,
    options = DEFAULT_OPTIONS
  } = desc;
  if (options === false) return desc;
  let cacheByOptions = cache.get(value);

  if (!cacheByOptions) {
    cacheByOptions = new WeakMap();
    cache.set(value, cacheByOptions);
  }

  let possibilities = cacheByOptions.get(options);

  if (!possibilities) {
    possibilities = [];
    cacheByOptions.set(options, possibilities);
  }

  if (possibilities.indexOf(desc) === -1) {
    const matches = possibilities.filter(possibility => 