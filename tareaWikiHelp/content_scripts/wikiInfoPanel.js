
class wikiInfoPanel{
    
    createWikiPanel(){
        let wikiPanel = document.createElement("div");
        document.body.insertBefore(wikiPanel, document.body.childNodes[0]);
        wikiPanel.setAttribute("id", "wikiList");
        wikiPanel.setAttribute("class", "modal");
        this.createWikiPanelContent(wikiPanel);
        return wikiPanel;
    }

    createWikiPanelContent(wikiPanel){
        let wikiPanelContent = document.createElement("div");
        wikiPanel.appendChild(wikiPanelContent);
        wikiPanelContent.setAttribute("class", "modal-content");
        wikiPanel.style.display = "block";
    }

    constructor() {   
        if (document.getElementById("wikiList") != null){
            document.getElementById("wikiList").remove();
        }
        this.wikiPanel = this.createWikiPanel();
      }
 
    insertWikiSeachToPanel(wikiSearch){
        if(wikiSearch != undefined){
            let i, wikiWord, wikiLink;
            for (i = 0; i < wikiSearch.length; i++) {
                wikiWord = wikiSearch[i];
                wikiLink = document.createElement("a");
                wikiLink.innerHTML = wikiWord.title;
                wikiLink.href = "https://es.wikipedia.org".concat(wikiWord.pathname);
                this.wikiPanel.firstChild.appendChild(wikiLink);
                this.wikiPanel.firstChild.appendChild(document.createElement("br"));
            }
            this.wikiPanel.firstChild.appendChild(document.createElement("br"));
        }
    }

}



/*
wikiSearch.forEach(function(wikiWord) 
{
    console.log(this);
    let wikiLink = document.createElement("a");
    wikiLink.innerHTML = wikiWord.title;
    wikiLink.href = "https://es.wikipedia.org".concat(wikiWord.pathname);
    this.wikiPanel.firstChild.appendChild(wikiLink);
    this.wikiPanel.firstChild.appendChild(document.createElement("br"));
}[this]);
this.wikiPanel.firstChild.appendChild(document.createElement("br"));

*/