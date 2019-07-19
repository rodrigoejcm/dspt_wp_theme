var public_spreadsheet_url = 'https://docs.google.com/spreadsheets/d/1JIolJhwKkVbL1Ywb4eZx_wN4ZgK18nBryoo8_P2iR6M/edit?usp=sharing';

//console.log(public_spreadsheet_url)

function init({ def_sheet="DSPT - Meetups" } = {}) {

    document.getElementById("loader").style.display = "block";
    //document.getElementById("myDiv").style.display = "block";
    //console.log(def_sheet)
    Tabletop.init({
        key: public_spreadsheet_url,
        callback: function(data, tabletop) { 
            showInfo(data, tabletop, def_sheet);
        },
        simpleSheet: false
    });
}

window.addEventListener('DOMContentLoaded', init)


///////// LINK FILTROS

var filtros = document.getElementsByClassName('filtro_timeline');

for (var i=0; i < filtros.length; i++) {
    filtros[i].onclick = function(){
        //console.log(this.getAttribute("name"));
        
        // Apaga valores anteriores
        var timeline = document.getElementById("timeline");
            while (timeline.firstChild) {
                timeline.removeChild(timeline.firstChild);
            }
        //

        // SET LOADER
        document.getElementById("loader").style.display = "block";

        // Clear all styles
        for (var i = 0, max = filtros.length; i < max; i++) {
            filtros[i].style['text-decoration'] = 'none';
            filtros[i].style['font-weight'] = 'normal';
        }
        
        // set this style

        
        this.style['text-decoration'] = 'underline';
        this.style['font-weight'] = 'bold';

        init({def_sheet:this.getAttribute("name") });
    }
};







function showInfo(data, tabletop, def_sheet) {
    // data comes through as a simple array since simpleSheet is turned on
    // alert("Successfully processed " + data.length + " rows!")
    // document.getElementById("food").innerHTML = "<strong>Foods:</strong> " + [data[0].Name, data[1].Name, data[2].Name].join(", ");
    
    console.log(def_sheet)
    //console.log(tabletop)
    console.log(data)
    console.log(tabletop)

    // DSPT - Meetups:
    // DSPT Day
    // Parcerias/Convites

    //console.log(data['Parcerias/Convites'])

    var timeline = document.getElementById("timeline");

    document.getElementById("loader").style.display = "none";

    data[def_sheet].elements.forEach(element => {
        
        var subtitle = "";
        var imagecss = "";
        var more = "more";
        var link = "<br/><br/>";


        if ( def_sheet != "Parcerias/Convites" && element.Location != "") {
            //subtitle = '<h4 class= "header-timeline" > '+ element.Observation +' </h4>'
            subtitle = '<h4 class= "header-timeline" ><br/> <span style="margin-right:5px;"class="iconlist-char " aria-hidden="true" data-av_icon="" data-av_iconfont="entypo-fontello"></span>'+ element['Location Detail'] +' </h4>'
        }else{
            if(element.Title != ""){
                subtitle = '<h4 class= "header-timeline-title-talk" > "'+ element['Title'] +'" </h4><h4 class= "header-timeline" ><br/><span style="margin-right:5px;"class="iconlist-char " aria-hidden="true" data-av_icon="" data-av_iconfont="entypo-fontello"></span>'+ element['Location Detail'] +' </h4>'
            }
            
        }

        if (element.Image != "") {
            style_location ='background-color: #ffd1bd; color: #222222;display: inline-block;padding: 3px;'
        }else{
            style_location ="background-color: #ffd1bd;display: inline-block;padding: 3px;"
        }    
            
        if(def_sheet == "Parcerias/Convites"){
            var imagediv = '<h2 class= "header-timeline">\
            <span style="'+style_location+'">'+ element['Location']+'</span> '+ element['Type'] + ' @ ' + element['Description'] +'</h2>' + subtitle ;
        }else{
            var imagediv = '<h2 class= "header-timeline">\
            <span style="'+style_location+'">'+ element['Location']+'</span> '+ element['Title'] +'</h2>' + subtitle ;
        }

        var space = "";
        

        if (element.Link != "") {
            link = '<a class="bnt-more link-timeline" style="display:none"  href="'+ element.Link +'">'+ more +'</a>'
        }

        if (element.Image != "") {
            imagecss = 'timeline-card';
            imagediv = '<div class="timeline-img-header" style="background: linear-gradient(rgba(0, 0, 0, 0) \
            , rgba(0, 0, 0, 0.9)), url('+element.Image+') center center no-repeat; background-size: cover;">' + imagediv + ' </div>';
            space = "";
        }

        

              
        
        var new_item = '<div class="timeline-item"> <div class="timeline-img"> \
        </div> \
        <div class="timeline-content '+ imagecss+' js--fadeInRight"> ' + imagediv + space + '\
          <div class="date">'+ element.Date +'</div> \
          <div style="display:none;">'+ element.Description +'</div> ' + link + '\
          <a class="bnt-more link-timeline"" href="#">More Information</a>  \
          </div> </div>'
          

        
       
        timeline.insertAdjacentHTML("beforeend", new_item);
    });

}
