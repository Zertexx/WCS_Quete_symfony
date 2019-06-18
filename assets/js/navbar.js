$("div").click(function(){
    $("div span:nth-of-type(1)").toggleClass("closeTop");
    $("div span:nth-of-type(2)").toggleClass("visible");
    $("div span:nth-of-type(3)").toggleClass("closeBottom");
    $(".header").toggleClass("height");
});