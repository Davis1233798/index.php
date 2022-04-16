//Jack 20220412 Survey共用Function
$(function(){

    //抽菸
    $("input[type='radio'][name='rd_smoke']").change(function(){

        if($(this).val()==3){

            $("#smoke_daily").prop('disabled', false);
            $("#smoke_year").prop('disabled', false);
        }else{

            $("#smoke_daily").prop('disabled', true);
            $("#smoke_year").prop('disabled', true);
        };
        if($(this).val()==4) {
            $("#smoke_fix_m").prop('disabled', false);
            $("#smoke_fix_y").prop('disabled', false);
        }else{
            $("#smoke_fix_m").prop('disabled', true);
            $("#smoke_fix_y").prop('disabled', true);
        }
    });
    //檳榔
    $("input[type='radio'][name='rd_binlang']").change(function(){

        if($(this).val()==3){

            $("#binlang_daily").prop('disabled', false);
            $("#binlang_year").prop('disabled', false);
        }else{

            $("#binlang_daily").prop('disabled', true);
            $("#binlang_year").prop('disabled', true);
        };
        if($(this).val()==4) {
            $("#binlang_fix_m").prop('disabled', false);
            $("#binlang_fix_y").prop('disabled', false);
        }else{
            $("#binlang_fix_m").prop('disabled', true);
            $("#binlang_fix_y").prop('disabled', true);
        }
    });
    //抽菸
    $("input[type='radio'][name='rd_smoke']").change(function(){

        if($(this).val()==3){

            $("#smoke_daily").prop('disabled', false);
            $("#smoke_year").prop('disabled', false);
        }else{

            $("#smoke_daily").prop('disabled', true);
            $("#smoke_year").prop('disabled', true);
        };
        if($(this).val()==4) {
            $("#smoke_fix_m").prop('disabled', false);
            $("#smoke_fix_y").prop('disabled', false);
        }else{
            $("#smoke_fix_m").prop('disabled', true);
            $("#smoke_fix_y").prop('disabled', true);
        }
    });
    //酒
    $("input[type='radio'][name='rd_wine']").change(function(){

        if($(this).val()==3){
            $("#wine_weekly").prop('disabled', false);
            $("#wine_type").prop('disabled', false);
            $("#wine_quota").prop('disabled', false);
        }else{
            $("#wine_weekly").prop('disabled', true);
            $("#wine_type").prop('disabled', true);
            $("#wine_quota").prop('disabled', true);
        };
        if($(this).val()==4) {
            $("#wine_fix_m").prop('disabled', false);
            $("#wine_fix_y").prop('disabled', false);
        }else{
            $("#wine_fix_m").prop('disabled', true);
            $("#wine_fix_y").prop('disabled', true);
        }
    });
});