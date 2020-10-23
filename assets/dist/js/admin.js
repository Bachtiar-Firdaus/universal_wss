// dropdown menu apabila didalam .menu li ko ada  ul lagi(berarti dropdown)
// bila a diklik apa yang terjadi
$(".menu li > a").click(function(e){
	// yang terjadi adlah ngeslide up dan slide down apabila punya anak menu
	$(".menu ul ul").slideUp(), $(this).next().is(":visible") || $(this).next().slideDown(),e.stopPropagation()
})

// dropdown menu apabila didalam .menu li ko ada  ul lagi(berarti dropdown)
// bila a diklik apa yang terjadi
$(".menu>ul > li>ul>li>a").click(function(e){
	// yang terjadi adlah ngeslide up dan slide down apabila punya anak menu
	$(".menu ul ul ul").slideUp(), $(this).next().is(":visible") || $(this).next().slideDown(),e.stopPropagation()
})
