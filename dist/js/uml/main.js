mermaid.initialize({
    startOnLoad: true
})



var exportSVG = function(svg) {
    // first create a clone of our svg node so we don't mess the original one
    var clone = svg.cloneNode(true);
    // parse the styles
    parseStyles(clone);

    // create a doctype
    var svgDocType = document.implementation.createDocumentType('svg', "-//W3C//DTD SVG 1.1//EN", "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd");
    // a fresh svg document
    var svgDoc = document.implementation.createDocument('http://www.w3.org/2000/svg', 'svg', svgDocType);
    // replace the documentElement with our clone 
    svgDoc.replaceChild(clone, svgDoc.documentElement);
    // get the data
    var svgData = (new XMLSerializer()).serializeToString(svgDoc);

    // now you've got your svg data, the following will depend on how you want to download it
    // e.g yo could make a Blob of it for FileSaver.js
    /*
    var blob = new Blob([svgData.replace(/></g, '>\n\r<')]);
    saveAs(blob, 'myAwesomeSVG.svg');
    */
    // here I'll just make a simple a with download attribute

    var a = document.createElement('a');
        a.href = 'data:image/svg+xml; charset=utf8, ' + encodeURIComponent(svgData.replace(/></g, '>\n\r<'));
        a.download = 'diagram_exported.svg';
        a.innerHTML = '<i class="fas fa-check"></i>';
        $( '#export_btn' ).html(a);
        $( '#export_btn a' ).addClass('btn btn-sm light-btn-bordered light-color mr-right');

};

var parseStyles = function(svg) {
    var styleSheets = [];
    var i;
    // get the stylesheets of the document (ownerDocument in case svg is in <iframe> or <object>)
    var docStyles = svg.ownerDocument.styleSheets;

    // transform the live StyleSheetList to an array to avoid endless loop
    for (i = 0; i < docStyles.length; i++) {
        styleSheets.push(docStyles[i]);
    }

    if (!styleSheets.length) {
        return;
    }

    var defs = svg.querySelector('defs') || document.createElementNS('http://www.w3.org/2000/svg', 'defs');
    if (!defs.parentNode) {
        svg.insertBefore(defs, svg.firstElementChild);
    }
    svg.matches = svg.matches || svg.webkitMatchesSelector || svg.mozMatchesSelector || svg.msMatchesSelector || svg.oMatchesSelector;


    // iterate through all document's stylesheets
    for (i = 0; i < styleSheets.length; i++) {
        var currentStyle = styleSheets[i]

        var rules;
        try {
            rules = currentStyle.cssRules;
        } catch (e) {
            continue;
        }
        // create a new style element
        var style = document.createElement('style');
        // some stylesheets can't be accessed and will throw a security error
        var l = rules && rules.length;
        // iterate through each cssRules of this stylesheet
        for (var j = 0; j < l; j++) {
            // get the selector of this cssRules
            var selector = rules[j].selectorText;
            // probably an external stylesheet we can't access
            if (!selector) {
                continue;
            }

            // is it our svg node or one of its children ?
            if ((svg.matches && svg.matches(selector)) || svg.querySelector(selector)) {

                var cssText = rules[j].cssText;
                // append it to our <style> node
                style.innerHTML += cssText + '\n';
            }
        }
        // if we got some rules
        if (style.innerHTML) {
        // append the style node to the clone's defs
            defs.appendChild(style);
        }
        
    }

};

$( "#export_btn" ).click(function() {
    $( this ).empty();
});



let orgDiagramName = $( '#diagram_name' ).html();

$('body').on('focusout', '#diagram_name', function() {
    
    if(orgDiagramName !== $(this).html()){
        console.log( $(this).html() );
    }else{
        console.log('pas de changement');
    };
});
$('#diagram_name').bind('keypress keydown keyup', function(e){
    if(e.keyCode == 13) { e.preventDefault(); }
 });
