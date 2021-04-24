function start(hash)
{
	setTimeout(function(){
		location.href = 'internal/app?x='+hash;
	},4500);
}

function nav(hash)
{
	setTimeout(function(){
		location.href = "/WebApparelECommerce/internal/app?x="+hash;
	},10);
}

