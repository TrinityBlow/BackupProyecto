
class wikipedia{

  constructor() {}
  
  static parseMultipleWikiResult(nodeHTML) {
    let i = 0;
    let wikiSearchList = [];
    while (i < nodeHTML.length && i < 5) {
      wikiSearchList.push({"title": nodeHTML[i].firstChild.title, "pathname":nodeHTML[i].firstChild.pathname});
      i++;
    }
    return wikiSearchList;
  }

  static parseOneWikiResult(word){
    let path = "/wiki/".concat(word);
    let wikiSearchList = [
      {"title": word, "pathname":path}];
    return wikiSearchList;
  }

  static llamado(htmlText,word){
    let parser = new DOMParser()
    let wikiSearchHTML = parser.parseFromString(htmlText, "text/html");
    let nodesHTML = wikiSearchHTML.getElementsByClassName("mw-search-result-heading");
    if(nodesHTML.length > 0){
      return wikipedia.parseMultipleWikiResult(nodesHTML);
    } else if (wikiSearchHTML.getElementsByClassName("mw-search-nonefound").length == 0) {
      return wikipedia.parseOneWikiResult(word);
    }
  }
 
  searchWikipediaWord(word){
    return fetch('https://es.wikipedia.org/w/index.php?search='.concat(word))
    .then(function(response){
      return wikipedia.llamado(response.text(),word);
    });
  }

}
