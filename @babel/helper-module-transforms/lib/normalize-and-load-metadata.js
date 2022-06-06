"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = normalizeModuleAndLoadMetadata;
exports.hasExports = hasExports;
exports.isSideEffectImport = isSideEffectImport;
exports.validateImportInteropOption = validateImportInteropOption;

var _path = require("path");

var _helperValidatorIdentifier = require("@babel/helper-validator-identifier");

var _helperSplitExportDeclaration = require("@babel/helper-split-export-declaration");

function hasExports(metadata) {
  return metadata.hasExports;
}

function isSideEffectImport(source) {
  return source.imports.size === 0 && source.importsNamespace.size === 0 && source.reexports.size === 0 && source.reexportNamespace.size === 0 && !source.reexportAll;
}

function validateImportInteropOption(importInterop) {
  if (typeof importInterop !== "function" && importInterop !== "none" && importInterop !== "babel" && importInterop !== "node") {
    throw new Error(`.importInterop must be one of "none", "babel", "node", or a function returning one of those values (received ${importInterop}).`);
  }

  return importInterop;
}

function resolveImportInterop(importInterop, source, filename) {
  if (typeof importInterop === "function") {
    return validateImportInteropOption(importInterop(source, filename));
  }

  return importInterop;
}

function normalizeModuleAndLoadMetadata(programPath, exportName, {
  importInterop,
  initializeReexports = false,
  lazy = false,
  esNamespaceOnly = false,
  filename
}) {
  if (!exportName) {
    exportName = programPath.scope.generateUidIdentifier("exports").name;
  }

  const stringSpecifiers = new Set();
  nameAnonymousExports(programPath);
  const {
    local,
    source,
    hasExports
  } = getModuleMetadata(programPath, {
    initializeReexports,
    lazy
  }, stringSpecifiers);
  removeModuleDeclarations(programPath);

  for (const [, metadata] of source) {
    if (metadata.importsNamespace.size > 0) {
      metadata.name = metadata.importsNamespace.values().next().value;
    }

    const resolvedInterop = resolveImportInterop(importInterop, metadata.source, filename);

    if (resolvedInterop =