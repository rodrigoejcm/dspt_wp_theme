
var options = {
			valueNames: ['name', 'project','location'],
			page: 50,
			plugins: [
			   ListPagination({})
			]
		};

var userList = new List('search-results', options);

var updateList = function () {
    var name = new Array();
    var project = new Array();
    var location = new Array();

    $("input:checkbox[name=project]:checked").each(function () {
        if($(this).val().indexOf('|') > 0){
            var arr = $(this).val().split('|');
            var arrayLength = arr.length;
            project = project.concat(arr);
            console.log('Multiple values:' + arr);
        }else{
            project.push($(this).val());
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

    var values_name = name.length > 0 ? name : null;
    var values_project = project.length > 0 ? project : null;
    var values_location = location.length > 0 ? location : null;

    userList.filter(function (item) {

        var locationTest;
        var projectTest;
        var nameTest;
        
        if(item.values().location.indexOf('|') > 0){
            var locationArr = item.values().location.split('|');
            for(var i = 0; i < locationArr.length; i++){
                if(_(values_location).contains(locationArr[i])){
                    locationTest = true;   
                }
            }
        }

        if(item.values().project.indexOf('|') > 0){
            var projectArr = item.values().project.split('|');
            for(var i = 0; i < projectArr.length; i++){
                if(_(values_project).contains(projectArr[i])){
                    projectTest = true;   
                }
            }
        }


        return (_(values_name).contains(item.values().name) || !values_name)
                && (_(values_location).contains(item.values().location) || !values_location  || locationTest)
                && (_(values_project).contains(item.values().project) || !values_project || projectTest )
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
var all_location = [];
var all_project = [];

updateList();

_(userList.items).each(function (item) {

    if(item.values().location.indexOf('|') > 0){
        var arr = item.values().location.split('|');
        all_location = all_location.concat(arr);
    }else{
        all_location.push(item.values().location)
    }

    if(item.values().project.indexOf('|') > 0){
        var arr = item.values().project.split('|');
        all_project = all_project.concat(arr);
    }else{
        all_project.push(item.values().project)
    }

    all_name.push(item.values().name)
    console.log(all_project)

});


_(all_name).uniq().each(function (item) {
    $(".nameContainer").append('<label><input type="checkbox" name="name" value="' + item + '">' + item + '</label>')
});

_(all_location).filter(function(e){return e}).uniq().each(function (item) {
    $(".locationContainer").append('<label><input type="checkbox" name="location" value="' + item + '">' + item + '</label>')
});

_(all_project).filter(function(e){return e}).uniq().each(function (item) {
    $(".projectContainer").append('<label><input type="checkbox" name="project" value="' + item + '">' + item + '</label>')
});


$(document).off("change", "input:checkbox[name=name]");
$(document).on("change", "input:checkbox[name=name]", updateList);
$(document).off("change", "input:checkbox[name=location]");
$(document).on("change", "input:checkbox[name=location]", updateList);
$(document).off("change", "input:checkbox[name=project]");
$(document).on("change", "input:checkbox[name=project]", updateList);