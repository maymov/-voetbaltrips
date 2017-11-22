$(document).ready(function(){
    var city, tournament, club, formdata, loadclubs, loadcities = '0';

    var ddDataC, ddDataCi, ddDataT = [];

    window.removeClubs = function() {
        club = 0;
        $('#club_id').val(0);
        getClubs();
    };

    window.removeCities = function() {
        city = 0;
        $('#city_id').val(0);
        loadclubs = 'yes';
        getCities();
    };

    window.removeTournaments = function() {
        tournament = 0;
        $('#tournament_id').val(0);
        loadclubs = 'yes';
        loadcities = 'yes';
        getTournaments();
    };

    $('#removeClub').click(function() {
        removeClubs();
        getMatches();
    });    

    $('#removeCity').click(function() {
        removeCities();
        removeClubs();
        getMatches();
    });    

    $('#removeTournament').click(function() {
        removeTournaments();
        removeCities();
        removeClubs();
        getMatches();
    });

    window.getVal = function() {
        city       = $("#city_id").val();
        tournament = $("#tournament_id").val();
        club = $('#club_id').val();
    };


    window.serializeForm = function() {

        formdata   = $("#searchmatch").serialize();
        if(loadclubs == 'yes' || loadcities == 'yes') {
            formdata = formdata + '&loadclub=yes';
        }
        if(loadcities == 'yes') {
            formdata = formdata + '&loadcities=yes';
        }

    }

    window.initializeDropdowns = function() {
        $.ajax({
            url      : "ajax/dropdowns",
            method   : "POST",
            dataType : "json",
            data     : formdata,
            beforeSend : function () {
                $('body').loadingModal({text: 'Please Wait...'});
            },
            complete : function(){
                $('body').loadingModal('destroy');
            },
            success  : function (resp) { 

                var ddDataT = [];
                var data = resp.response;
                if(typeof data[2] !="undefined" && data[2].length > 0) {
                    renewTournaments(data[2]); 
                }    


                if(typeof data[1] !="undefined" && data[1].length > 0) {
                    renewClubs(data[1]);   
                }    

                ddDataCi = [];
                if(typeof data[0] !="undefined" && data[0].length > 0) {
                    renewCities(data[0]);
                }    
            }
        });

    }

    window.getTournaments = function() {
        getVal();
        serializeForm();

        $.ajax({
            url      : "ajax/tournamentsForDD",
            method   : "POST",
            dataType : "json",
            data     : formdata,
            beforeSend : function () {
                $('body').loadingModal({text: 'Please Wait...'});
            },
            complete : function(){
                $('body').loadingModal('destroy');
            },
            success  : function (resp) {
                if(typeof resp.tournaments !="undefined") {
                    renewTournaments(resp.tournaments);
                }
            }
        });

    };

    window.renewTournaments = function(tournaments) {
        ddDataT = [];
        $('#tournament').ddslick("destroy");
        $("#tournament").empty();

        $.each(tournaments, function(index, value){
            ddDataT.push({
                text: value.name,
                value: value.id,
                selected: tournament == value.id ? true : false,
                imageSrc: window.location.origin+"/uploads/tournaments/"+value.image
            });
        });    

        $('#tournament').ddslick({
                data:ddDataT, 
                selectText: tournamentTextSelected,
                onSelected: function(data){
                    filterMatches('no', 'yes');
                }
        });
    }

    window.getClubs = function() {
        getVal();
        serializeForm();

        $.ajax({
            url      : "ajax/clubsForDD",
            method   : "POST",
            dataType : "json",
            data     : formdata,
            beforeSend : function () {
                $('body').loadingModal({text: 'Please Wait...'});
            },
            complete : function(){
                $('body').loadingModal('destroy');
            },
            success  : function (resp) {
                if(typeof resp.clubs !="undefined") {
                    renewClubs(resp.clubs);
                }
            }
        });

    };

    window.renewClubs = function(clubs) {
        ddDataC = [];
        $('#club').ddslick("destroy");
        $("#club").empty();

        $.each(clubs, function(index, value){
            ddDataC.push(
                {
                    text: value.name,
                    value: value.id,
                    selected: club == value.id ? true : false,
                    imageSrc: window.location.origin+"/uploads/teamemblems/"+value.emblem
                }
            );
        });

        $('#club').ddslick({
                data:ddDataC, 
                selectText: clubTextSelected,
                onSelected: function(data){
                    filterMatches('no', 'no');
                }
        });
    }

    window.getCities = function() {
        getVal();
        serializeForm();

        $.ajax({
            url      : "ajax/citiesForDD",
            method   : "POST",
            dataType : "json",
            data     : formdata,
            beforeSend : function () {
                $('body').loadingModal({text: 'Please Wait...'});
            },
            complete : function(){
                $('body').loadingModal('destroy');
            },
            success  : function (resp) {
                if(typeof resp.cities !="undefined") {
                    renewCities(resp.cities);
                }
            }
        });

    };

    window.renewCities = function(cities) {
        ddDataCi = [];
        $('#city').ddslick("destroy");
        $("#city").empty();

        $.each(cities, function(index, value){
            ddDataCi.push(
                {
                    text: value.cityName,
                    value: value.id,
                    selected: city == value.id ? true : false,
                    imageSrc: window.location.origin+"/uploads/flags/"+value.flag
                }
            );
        });

        $('#city').ddslick({
                data:ddDataCi, 
                selectText: cityTextSelected,
                onSelected: function(data){
                    filterMatches('yes', 'no');
                }
        });
    }

    window.getMatches = function() {
        if(club == 0  && city == 0 && tournament == 0) {
            $("#allmatcheslist").html('');
        } else {
                $.ajax({
                        url      : "ajax/tickets",
                        method   : "POST",
                        dataType : "json",
                        data     : formdata,
                        beforeSend : function () {
                            $('body').loadingModal({text: 'Please Wait...'});
                        },
                        complete : function(){
                            $('body').loadingModal('destroy');
                        },
                        success  : function (resp) {

                            if(resp.length > 0  && resp.status != "empty") {
                                    var match = '';
                                    var scr = window.screen.width;
                                    resp.forEach(function(value,index) {
                                        for (var val in value) {
                                            //console.log(value[val].match_date);
                                            //console.log(window.screen.width)
                                            var string = value[val].home_club +' - '+ value[val].away_club;
                                            if (scr > 420) {
                                                match = match + '<li>' +
                                                    '<time datetime="2017-07-01">' +
                                                        '<span class="day">'+ value[val].match_date +'</span>' +
                                                        '<span class="month">'+ value[val].match_month +'</span>' +
                                                        '<span class="year">2017</span>' +
                                                        '<span class="time">ALL DAY</span>' +
                                                    '</time>' +
                                                    '<div class="info">' +
                                                    '<img id="homeemblem" style="margin-left: 0" src="'+value[val].home_club_emblem+'">';
                                                        if (32 < string.length && string.length && scr > 1170) {
                                                            match += '<div class="club-emblem"><h2 class="title" style="font-size:14pt; padding-top: 11%;">' + value[val].home_club + ' - ' + value[val].away_club + '</h2>';
                                                        } else if (37 >= string.length && string.length > 26  &&  769 >= scr && scr > 380) {
                                                            match += '<div class="club-emblem"><h2 class="title" style="font-size:14pt; padding-top: 14%;">'+ value[val].home_club +' - '+ value[val].away_club +'</h2>';
                                                        } else if (string.length >= 36 &&  768 >= scr && scr > 380) {
                                                            match += '<div class="club-emblem"><h2 class="title" style="font-size:12pt;">'+ value[val].home_club +' - '+ value[val].away_club +'</h2>';
                                                        } else {
                                                            match += '<div class="club-emblem"><h2 class="title">'+ value[val].home_club +' - '+ value[val].away_club +'</h2>';
                                                        }
                                                        match += '<p class="desc">'+ value[val].city_name +', '+ value[val].country_name +'</p></div>' +
                                                                 '<img id="awayemblem" style="margin-right: 0" src="'+value[val].away_club_emblem+'">' +
                                                                '</div>' +
                                                                '<div class="buttonwrap">' +
                                                                    '<ul>' +
                                                                        '<li id="price-string">' +
                                                                            value[val].label_since+' <p id="price-num"> &euro;'+ value[val].min_price+'</p> '+
                                                                        '</li>' +
                                                                        '<li>' +
                                                                            '<a data-match="'+value[val].match_id+'" href="addticket/'+ value[val].match_id +'" class="btn btn-primary bookpackage">' +value[val].button_book+'</a>' +
                                                                        '</li>' +

                                                                    '</ul>' +
                                                                '</div>' +
                                                        '</li>';

                                            } else {
                                                match = match + '<li>' +
                                                    '<time datetime="2017-07-01">' +
                                                        '<span class="day">'+ value[val].match_date +'</span>' +
                                                        '<span class="month">'+ value[val].match_month +'</span>' +
                                                        '<span class="year">2017</span>' +
                                                        '<span class="time">ALL DAY</span>' +
                                                    '</time>' +
                                                    '<div class="info">' +
                                                        '<div id="clubs-images">' +
                                                            '<img id="homeemblem" src="'+value[val].home_club_emblem+'"> ' +
                                                            '<p></p>' +
                                                            '<img id="awayemblem" style="margin-right: 10px; float:right; width: 100px" src="'+value[val].away_club_emblem+'">' +
                                                        '</div>'+
                                                        '<div class="club-emblem">';
                                                if (string.length >= 29 && string.length <= 34 ) {
                                                    match += '<h2 class="title" style="font-size:14pt;">'+ value[val].home_club +' - '+ value[val].away_club +'</h2>';
                                                } else if (string.length >= 35) {
                                                    match += '<h2 class="title" style="font-size:12pt;">'+ value[val].home_club +' - '+ value[val].away_club +'</h2>';
                                                } else {
                                                    match += '<h2 class="title">'+ value[val].home_club +' - '+ value[val].away_club +'</h2>';
                                                }
                                                match += '<p class="desc">'+ value[val].city_name +', '+ value[val].country_name +'</p></div>' +
                                                    '</div>' +
                                                    '<div class="buttonwrap">' +
                                                        '<ul>' +
                                                            '<li id="price-string">' +
                                                                value[val].label_since+' <p id="price-num"> &euro;'+ value[val].min_price+'</p> '+
                                                            '</li>' +
                                                            '<li>' +
                                                                '<a data-match="'+value[val].match_id+'" href="addticket/'+ value[val].match_id +'" class="btn btn-primary bookpackage">' +value[val].button_book+'</a>' +
                                                            '</li>' +
                                                        '</ul>' +
                                                    '</div>' +
                                                '</li>';
                                            }
                                        }
                                    });
                                $("#allmatcheslist").html(match);
                                //$("#sortform").show();
                            } else {
                                var ansver = '<li><p align="center" style="padding: 46px;">'+resp.matches.message+'</p></li>';
                                $("#sortform").hide();
                                $("#allmatcheslist").html(ansver);
                            }

                            /**
                             * Loading the cities to select box
                             */
                            if(typeof resp.cities !="undefined" && tournament != 0 && loadcities == 'yes') {
                                renewCities(resp.cities);
                            }

                            /**
                             * Loading the clubs to select box
                             */
                            if(typeof resp.clubs !="undefined" && loadclubs == 'yes') {
                                renewClubs(resp.clubs);
                            }
                        }
                    });
                }
    }

    window.filterMatches = function(loadclub, loadcity = 'no') {
        loadcities = loadcity;
        loadclubs = loadclub; 

        ddDataC, ddDataCi, ddDataT = [];

        getVal();

        if($('#club').data('ddslick') && null != $('#club').data('ddslick').selectedData) {
            club  = $('#club').data('ddslick').selectedData.value;
        }

        if($('#tournament').data('ddslick') && null != $('#tournament').data('ddslick').selectedData) {
            tournament  = $('#tournament').data('ddslick').selectedData.value;
        }

        if($('#city').data('ddslick') && null != $('#city').data('ddslick').selectedData) {
            city  = $('#city').data('ddslick').selectedData.value;
        }

        if(club != 0) {
            $('#club_id').val(club);
        }
        if(city != 0) {
            $('#city_id').val(city);
        }
        if(tournament != 0) {
            $('#tournament_id').val(tournament);
        }

        serializeForm();

        if($('#city').data('ddslick') == undefined && $('#club').data('ddslick') == undefined && $('#tournament').data('ddslick') == undefined) {
            initializeDropdowns();
        }

        if(city != 0 || tournament != 0 || club != 0) {   
            getMatches();
        }
    };


$('.nav-tabs a').click(function(){
        $(this).tab('show');
    });
    $(".match_date").datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    }).on('changeDate', function(ev){
        filterMatches('no');
    });
    $(".sort").on("click", function () {
        $("#sorttype").val($(this).data("sort"));
        $("#sortorder").val($(this).data("sorttype"));
        filterMatches();
    });
    $("body").on("click", ".bookpackage", function(e){
        e.preventDefault();
        var hh = $(this).attr('href');
        var match = $(this).data("match");
        $.ajax({
            url         : window.location.protocol + "//" + window.location.hostname + "/" + hh,
            method      : "POST",
            dataType    : "json",
            data        : { "_token"   : $("[name=_token]").val()},
            beforeSend  : function(){
                $('body').loadingModal({text: 'Please Wait...'});
            },
            complete    : function () {
                $('body').loadingModal('destroy');
            },
            success     : function(resp) {
                if(resp.status == "success") {
                    window.location.href = window.location.protocol + "//" + window.location.hostname + "/" + "tickets/" + match;
                } else {
                    Lobibox.notify("error",
                        {
                            msg : resp.message
                        }
                    );
                }
            },
            error       : function (err) {
                Lobibox.notify("error",
                    {
                        msg : "Something went wrong. Please try again later."
                    }
                );
            }
        })
    });
    if($("#ajaxload_match").val() == "yes") {
        filterMatches("no");
    }
});