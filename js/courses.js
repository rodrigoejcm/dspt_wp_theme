
var options = {
			valueNames: ['name','insti', 'ctype','location','topic'],
			page: 50,
			plugins: [
			   ListPagination({})
			]
		};

var userList = new List('search-results', options);

var updateList = function () {
    var name = new Array();
    var insti = new Array();
    var ctype = new Array();
    var location = new Array();
    var topic = new Array();

    $("input:checkbox[name=ctype]:checked").each(function () {
        if($(this).val().indexOf('|') > 0){
            var arr = $(this).val().split('|');
            var arrayLength = arr.length;
            ctype = ctype.concat(arr);
            console.log('Multiple values:' + arr);
        }else{
            ctype.push($(this).val());
            console.log('Single values:' + arr);
        }
    });

    $("input:checkbox[name=location]:checked").each(function () {
        if($(this).val().indexOf('|') > 0){
            var arr = $(this).val().split('|');
            var arrayLength = arr.length;
            location = location.concat(arr);
            console.log('Multiple values:' + arr);
        }else{
            location.push($(this).val());
            console.log('Single values:' + arr);
        }
    });

    $("input:checkbox[name=topic]:checked").each(function () {
        if($(this).val().indexOf('|') > 0){
            var arr = $(this).val().split('|');
            var arrayLength = arr.length;
            topic = topic.concat(arr);
            console.log('Multiple values:' + arr);
        }else{
            topic.push($(this).val());
            console.log('Single values:' + arr);
        }
    });

    var values_name = name.length > 0 ? name : null;
    var values_insti = insti.length > 0 ? insti : null;
    var values_ctype = ctype.length > 0 ? ctype : null;
    var values_location = location.length > 0 ? location : null;
    var values_topic = topic.length > 0 ? topic : null;

    userList.filter(function (item) {

        var locationTest;
        var ctypeTest;
        var topicTest;
        var nameTest;
        var instiTest;
        
        if(item.values().location.indexOf('|') > 0){
            var locationArr = item.values().location.split('|');
            for(var i = 0; i < locationArr.length; i++){
                if(_(values_location).contains(locationArr[i])){
                    locationTest = true;   
                }
            }
        }

        if(item.values().ctype.indexOf('|') > 0){
            var ctypeArr = item.values().ctype.split('|');
            for(var i = 0; i < ctypeArr.length; i++){
                if(_(values_ctype).contains(ctypeArr[i])){
                    ctypeTest = true;   
                }
            }
        }

        if(item.values().topic.indexOf('|') > 0){
            var topicArr = item.values().topic.split('|');
            for(var i = 0; i < topicArr.length; i++){
                if(_(values_topic).contains(topicArr[i])){
                    topicTest = true;   
                }
            }
        }


        return (_(values_name).contains(item.values().name) || !values_name)
                && (_(values_insti).contains(item.values().insti) || !values_insti)
                && (_(values_location).contains(item.values().location) || !values_location  || locationTest)
                && (_(values_topic).contains(item.values().topic) || !values_topic || topicTest )
                && (_(values_ctype).contains(item.values().ctype) || !values_ctype || ctypeTest )
    });
}

userList.on("updated", function () {
    $('.sort').each(function () {
        if ($(this).hasClass("asc")) {
            $(this).find(".fa").addClass("fa-sort-alpha-asc").removeClass("fa-sort-alpha-desc").show();
        } else if ($(this).hasClass("desc")) {
            $(this).find(".fa").addClass("fa-sort-alpha-desc").removeClass("fa-sort-alpha-asc").show();
        } else {
            $(this).find(".fa").hide();
        }
    });
});

var all_name = [];
var all_insti = [];
var all_location = [];
var all_topic = [];
var all_ctype = [];

updateList();

_(userList.items).each(function (item) {

    if(item.values().location.indexOf('|') > 0){
        var arr = item.values().location.split('|');
        all_location = all_location.concat(arr);
    }else{
        all_location.push(item.values().location)
    }

    if(item.values().ctype.indexOf('|') > 0){
        var arr = item.values().ctype.split('|');
        all_ctype = all_ctype.concat(arr);
    }else{
        all_ctype.push(item.values().ctype)
    }

    if(item.values().topic.indexOf('|') > 0){
        var arr = item.values().topic.split('|');
        all_topic = all_topic.concat(arr);
    }else{
        all_topic.push(item.values().topic)
    }

    all_name.push(item.values().name)
    all_insti.push(item.values().insti)
    console.log(all_name)


});


_(all_name).uniq().each(function (item) {
    $(".nameContainer").append('<label><input type="checkbox" name="name" value="' + item + '">' + item + '</label>')
});

_(all_location).map(s => s.trim()).filter(function(e){return e}).uniq().each(function (item) {
    $(".locationContainer").append('<label><input type="checkbox" name="location" value="' + item + '">' + item + '</label>')
});

_(all_ctype).map(s => s.trim()).filter(function(e){return e}).uniq().each(function (item) {
    $(".ctypeContainer").append('<label><input type="checkbox" name="ctype" value="' + item + '">' + item + '</label>')
});

_(all_topic).map(s => s.trim()).filter(function(e){return e}).uniq().each(function (item) {
    $(".topicContainer").append('<label><input type="checkbox" name="topic" value="' + item + '">' + item + '</label>')
});


$(document).off("change", "input:checkbox[name=name]");
$(document).on("change", "input:checkbox[name=name]", updateList);
$(document).off("change", "input:checkbox[name=location]");
$(document).on("change", "input:checkbox[name=location]", updateList);
$(document).off("change", "input:checkbox[name=ctype]");
$(document).on("change", "input:checkbox[name=ctype]", updateList);
$(document).off("change", "input:checkbox[name=topic]");
$(document).on("change", "input:checkbox[name=topic]", updateList);