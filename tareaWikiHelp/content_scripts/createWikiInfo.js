class createWikiInfo{
    
    constructor() {         
        this.wordsToFetch = Array.prototype.slice.call(document.getElementsByTagName("h1"));
    }

    searchForWords(wordsToFetch){
        let wikiTalk = new wikipedia(), i, j, wikiSearchPromisesList = [], words, wikiSearchPromise;
        for (i = 0; i < wordsToFetch.length; i++) { 
            words = wordsToFetch[i].innerHTML.trim().split(" ");
            for (j = 0; j < words.length; j++) {
                if (words[j].length > 4){
                    wikiSearchPromise = wikiTalk.searchWikipediaWord(words[j]);
                    wikiSearchPromisesList.push(wikiSearchPromise);   
                }
            }
        }
        return wikiSearchPromisesList;
    }

    createWikiDivPanel(wikiSearchPromisesList){
        Promise.all(wikiSearchPromisesList).then(wikiSearch => {
            let wikiPanelCreator = new wikiInfoPanel();
            wikiSearch.forEach(function(wikiSearch){
                wikiPanelCreator.insertWikiSeachToPanel(wikiSearch);
            });
        });
    }

    createWikiPanel (){
        let wikiSearchPromisesList = this.searchForWords(this.wordsToFetch);
        this.createWikiDivPanel(wikiSearchPromisesList);        
    }

    closePanel(){
        document.getElementById("wikiList").style.display = "none";
    }


}


function toolbarButton (){
    wikiCreator.createWikiPanel();
    browser.runtime.onMessage.removeListener(toolbarButton);
    browser.runtime.onMessage.addListener(closeButton);
}


function closeButton(){
    wikiCreator.closePanel();
    browser.runtime.onMessage.removeListener(closeButton);
    browser.runtime.onMessage.addListener(toolbarButton);
}


var wikiCreator = new createWikiInfo();
browser.runtime.onMessage.addListener(toolbarButton);


window.onclick = function(event) {
    if (event.target == document.getElementById("wikiList")) {
        document.getElementById("wikiList").style.display = "none";
        browser.runtime.onMessage.addListener(toolbarButton);
    }
}




        /*
        this.wordsToFetch.forEach(function(value)
        { 
            value.innerHTML.trim().split(" ").forEach(function(word)
            {
                if(word.length > 4){
                    this.wikiSearchPromise = wikiTalk.searchWikipediaWord(word);
                    this.wikiSearchPromisesList.push(this.wikiSearchPromise);    
                }
            });
        });*/