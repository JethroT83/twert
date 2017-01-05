

var webdriver = require("node_modules/selenium-webdriver");

var driver = new webdriver.Builder().forBrowser('chrome').build();

driver.get("twitter.com");