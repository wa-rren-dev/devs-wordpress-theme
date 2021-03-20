module.exports = {
  parser: "@typescript-eslint/parser",
  plugins: ["@typescript-eslint"],
  extends: [
    "eslint:recommended",
    "plugin:@typescript-eslint/recommended",
    "@nice-digital/eslint-config/es6",
  ],
  env: {
    // For more environments, see here: http://eslint.org/docs/user-guide/configuring.html#specifying-environments
    browser: true,
    es6: true,
    jquery: false,
  },
  rules: {
    // Insert custom rules here
    // For more rules, see here: http://eslint.org/docs/rules/
    "no-invalid-this": "off",
    "no-var": "warn",
    "require-jsdoc": "off",
  },
  parserOptions: {
    sourceType: "module",
  },
};
