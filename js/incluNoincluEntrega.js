function crearListaIncluNoincluEntrega(tipo)
{	
	// parametro indica si se trata de una version anterior y no es pk no se pone nada mas que una leyenda
	
	cnt='<div class="card blue darken-2 white-text cardImn">';
	cnt+='<div class="card-content CardsGrafInNoEn">';
	   cnt+='<ul id="tabs-swipe-demo" class="tabs">';
	   		if(tipo!=15) // Las caseras no incluyen incluye   
	   		{
	   			cnt+='<li class="tab col s3"><a class="active"  href="#test-swipe-1"><span class="blue-text text-darken-2">Incluye</span></a></li>';	
	   		}
    		
    		cnt+='<li class="tab col s3"><a href="#test-swipe-2"><span class="blue-text text-darken-2">No Incluye</span></a></li>'; 
    		if(tipo==2)   		 
    		{
    			cnt+='<li class="tab col s3"><a href="#test-swipe-3"><span class="blue-text text-darken-2">Entrega</span></a></li>';    	    			
    		}
  	   cnt+='</ul>';
  	   if(tipo!=15) // Las caseras no incluyen incluye   
  	   {
  	   		cnt+='<div id="test-swipe-1" class="col s12 white"><ul id="ulIncluye"></ul></div>';	
  	   }
	   
	   cnt+='<div id="test-swipe-2" class="col s12 white"><ul id="ulNoIncluye"></ul></div>'; 
	   if(tipo==2)
	   {
	   		cnt+='<div id="test-swipe-3" class="col s12 white"><ul id="ulEntregar"></ul></div>';  	 	
	   }   		 
	cnt+='</div>';//card-content
	cnt+='</div>';//card
	
	cnt+='<script>';
	cnt+='$(document).ready(function(){';
	    cnt+="$('ul.tabs').tabs();";
	cnt+='});';
	cnt+='</script>';
	$('#divIncluNoincluEntregaPTAR').html(cnt);	
}
function mostrarIncluyeHTML(resp)
{
	var valores = eval(resp);			
	var contIncluye="";

	for(i=0;i<valores.length;i++)
	{

		var anchoPantalla = window.innerWidth;
		var concepto = valores[i].Concepto;
		var carMax = (anchoPantalla * 0.0297);
		var Indice = valores[i].Indice;

		var checked = "";
		if(valores[i].Activa==1)
		{
			checked="checked";
		}
		if(carMax<concepto.length)
		{
			concepto = concepto.substring(0,carMax)+"...";
		}
		contIncluye+='<p><input type="checkbox" id="checkInclu'+Indice+'" class="filled-in" value="'+Indice+'" '+checked+'/>';
  		contIncluye+='<label for="checkInclu'+Indice+'">'+concepto+'</label></p>';	
	}
	$('#ulIncluye').html(contIncluye);					
}	     
function mostrarNoIncluyeHTML(resp)
{

	var valores = eval(resp);			
	var contNoIncluye="";

	for(i=0;i<valores.length;i++)
	{

		var anchoPantalla = window.innerWidth;
		var concepto = valores[i].Concepto;
		var carMax = (anchoPantalla * 0.0297);
		var Indice = valores[i].Indice;

		var checked = "";

		if(valores[i].Activa==1)
		{
			checked="checked";

		}

		if(carMax<concepto.length)
		{
			concepto = concepto.substring(0,carMax)+"...";
		}
		
		contNoIncluye+='<p><input type="checkbox" id="checkNoInclu'+Indice+'" class="filled-in" value="'+Indice+'" '+checked+'/>';
		contNoIncluye+='<label for="checkNoInclu'+Indice+'">'+concepto+'</label></p>';		
	}

	$('#ulNoIncluye').html(contNoIncluye);						
}
function mostrarEntregarHTML(resp)
{
	var valores = eval(resp);
	var contEntrega="";
	for(i=0;i<valores.length;i++)
	{

		var anchoPantalla = window.innerWidth;
		var concepto = valores[i].Concepto;
		var carMax = (anchoPantalla * 0.0297);
		var Indice = valores[i].Indice;

		var checked = "";

		if(valores[i].Activa==1)
		{
			checked="checked";

		}

		if(carMax<concepto.length)
		{
			concepto = concepto.substring(0,carMax)+"...";
		}
		
		contEntrega+='<p><input type="checkbox" id="checkEntrega'+Indice+'" class="filled-in" value="'+Indice+'" '+checked+'/>';
		contEntrega+='<label for="checkEntrega'+Indice+'">'+concepto+'</label></p>';
	}
	$('#ulEntregar').html(contEntrega);
}