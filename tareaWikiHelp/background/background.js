
browser.browserAction.onClicked.addListener(wikiList);

function wikiList(tab){
  browser.tabs.sendMessage(tab.id,"null");
};
