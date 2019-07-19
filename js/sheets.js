var public_spreadsheet_url = 'https://docs.google.com/spreadsheets/d/1JIolJhwKkVbL1Ywb4eZx_wN4ZgK18nBryoo8_P2iR6M/edit?usp=sharing';

//console.log(public_spreadsheet_url)



function init({ def_sheet="Eventos", filtro_name='',filtro_type='' } = {}) {

    document.getElementById("loader").style.display = "block";
    //document.getElementById("myDiv").style.display = "block";
    //console.log(def_sheet)
    Tabletop.init({
        key: public_spreadsheet_url,
        callback: function(data, tabletop) { 
            showInfo(data, tabletop, def_sheet,filtro_name,filtro_type);
        },
        simpleSheet: false
    });
}

window.addEventListener('DOMContentLoaded', init)


///////// LINK FILTROS




var type_part = ['DSPT Day',
                'Jury',
                'MasterClass',
                'Meetup',
                'Moderador Round Table',
                'Stand',
                'Support',
                'Talk',
                'Workshop',
                'Hackathon']

var type_org = ['Partnership',
                'Guest',
                'Organizer']


var filtros = document.getElementsByClassName('filtro_timeline');

// <a href="#" class="filtro_timeline" 
// style="margin-right: 15px; text-decoration:underline; font-weight: bold;" 
// name='DSPT - Meetups'>DSPT Meetups</a>


var element_link_org = document.getElementById('links');
var element_link_part = document.getElementById('links_other');

//type_part.forEach(build_links_part);
type_org.forEach(build_links_org);


//var a = document.createElement('a');
//a.setAttribute('href','#');
//a.setAttribute('class','filtro_timeline');
//a.setAttribute('data-type-filter','part');
//a.innerHTML = 'All';
//a.name = 'All';
//element_link_part.appendChild(a);

//function build_links_part(value){
//    var a = document.createElement('a');
//    a.setAttribute('href','#');
//    a.setAttribute('class','filtro_timeline');
//    a.setAttribute('data-type-filter','part');
//    a.innerHTML = value;
//    a.name = value;
//    element_link_part.appendChild(a);

//}


function build_links_org(value){
    var a = document.createElement('a');
    a.setAttribute('href','#');
    a.setAttribute('class','filtro_timeline');
    a.setAttribute('data-type-filter','org');
    
    a.innerHTML = value;
    a.name = value;
    element_link_org.appendChild(a);
}


var a = document.createElement('a');
a.setAttribute('href','#');
a.setAttribute('class','filtro_timeline');
a.setAttribute('data-type-filter','org');
a.setAttribute('style','text-decoration:underline; font-weight: bold;');
a.innerHTML = 'All';
a.name = 'All';
element_link_org.prepend(a);



// apend the anchor to the body
// of course you can append it almost to any other dom element



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

        init({filtro_name:this.getAttribute("name"),filtro_type:this.getAttribute("data-type-filter") });
    }
};







function showInfo(data, tabletop, def_sheet, filtro_name = "", filtro_type='') {
    // data comes through as a simple array since simpleSheet is turned on
    // alert("Successfully processed " + data.length + " rows!")
    // document.getElementById("food").innerHTML = "<strong>Foods:</strong> " + [data[0].Name, data[1].Name, data[2].Name].join(", ");
    
    if(filtro_name=="All"){
        filtro_name = '';
    }

    if(filtro_name){
        
        console.log(data['Eventos'])
        console.log(data['Eventos'].elements)

        data_to_show = data['Eventos'].elements.filter(function (el) {
            return el['Type Participation'] == filtro_name ; // Changed this so a home would match
        });

    }else{
        data_to_show = data['Eventos'].elements;
    }

    

    // "typeparticipation"

    var timeline = document.getElementById("timeline");

    document.getElementById("loader").style.display = "none";

    data_to_show.forEach(element => {

        switch(element['Type of Participation']) {
            case "Meetup":
                var participation_class = "timeline_meetup";
                break;
            case "Guest":
                var participation_class = "timeline_guest";
                break;
            default:
                var participation_class = "timeline_unknown";
        }
        
        var subtitle = "";
        var imagecss = "";
        var sub_type_part = " - " + element['Type'];
        var more = "more";
        var link = "<br/><br/>";


        if ( def_sheet != "Parcerias/Convites" && element.Location != "") {
            //subtitle = '<h4 class= "header-timeline" > '+ element.Observation +' </h4>'
            subtitle = '<h4 class= "header-timeline" ></span></span> <span style="margin-right:5px;"class="iconlist-char " aria-hidden="true" data-av_icon="" data-av_iconfont="entypo-fontello"></span>'+ element['Location Detail'] +'</h4>'
        }else{
            if(element.Title != ""){
                subtitle = '<h4 class= "header-timeline-title-talk" > "'+ element['Title'] +'" </h4><h4 class= "header-timeline" ><span style="margin-right:5px;"class="iconlist-char " aria-hidden="true" data-av_icon="" data-av_iconfont="entypo-fontello"></span>'+ element['Location Detail'] +' </h4>'
            }
            
        }

        if (element.Image != "") {
            style_location ='background-color: #ffd1bd; color: #222222;display: inline-block;padding: 3px;margin-bottom:3px;'
        }else{
            style_location ="background-color: #ffd1bd;display: inline-block;padding: 3px; margin-bottom:3px;"
        }    
            
        if(def_sheet == "Parcerias/Convites"){
            var imagediv = '<h2 class= "header-timeline">\
            <span style="'+style_location+'">'+ element['Location']+'</span> ' +  sub_type_part + ' <h2/>\
            <h2 class= "header-timeline"> '+ element['Type'] + ' @ ' + element['Description'] +'</h2>' + subtitle ;
        }else{
            var imagediv = '<h2 class= "header-timeline">\
            <span style="'+style_location+'">'+ element['Location']+  sub_type_part + '</span> \
            </span> <br\>'+ element['Title'] + '</h2>' + subtitle ;
        }

        var space = "";
        

        if (element.Link != "") {
            link = '<a class="bnt-more link-timeline"  href="'+ element.Link +'">'+ 'More Information' +'</a>'
        }else{
            link = ''
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
          <div class="date"><p class="date_number">'+ element.Date +'</p><p class="date_part">'+element['Type Participation']+'</p></div> \
          <div style="display:none;">'+ element.Description +'</div> ' + link + '\
          </div> </div>'
          

        
       
        timeline.insertAdjacentHTML("beforeend", new_item);
    });

}
