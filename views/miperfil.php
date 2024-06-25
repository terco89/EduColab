<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css
">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js
">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js
">

<link rel="stylesheet" href="css/miperfil.css">
<style>
    .option-form {
        width: 8rem;
        display: inline-block;
    }

    .lbl {
        display: block;
        text-align: center;
        filter: opacity(0);
    }

    .void {
        width: 0px;
        height: 8rem;
        object-fit: cover;
        filter: opacity(0);
    }

    .Height {
        display: inline-block;
        width: 0px;
    }

    .option-photo {
        margin: 0, 0, 0, 0;
        width: 8rem;
        height: 8rem;
        object-fit: cover;
        transition: filter 0.2s, margin-bottom 0.2s ease-in-out;
    }

    .option-form:hover .option-photo {
        border: 2px solid #333;
        filter: brightness(40%);
        background-color: rgba(33, 33, 33, 0);
        margin-bottom: 10px;
    }

    .profile {
        transition: 0.3s filter ease-in-out;
    }

    .profile:hover {
        border: 0px solid #333;
        background-color: rgba(33, 33, 33, 0);
        filter: brightness(40%);
        @media only screen and  (max-width:1200px) {
            
        }
    }
</style>
<br>
<div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
    <div class="card p-4" style="cursor:default;">
        <div class="d-flex flex-column justify-content-center align-items-center" style=" margin-top:-50px;">
            <div class="fff" style=" margin-left:-50px;">
                <div class="cont" style="cursor:pointer;">
                    <div><img href="#" data-toggle="modal" data-target="#editPhoto" class="profile" src="img/foto_perfil/<?php echo $_SESSION['usuario']['img']; ?>" height="150" width="150" style="object-fit: cover; background-color:White; border-radius: 10px 10px 10px 10px; border: 2px solid black " /></div>
                    <div class="cent_tex" href="#" data-toggle="modal" data-target="#editPhoto"><i class="fa fa-pencil-square-o"></i></div>
                </div>
                <br>
                <span class="name mt-3" style="font-size:25px;"><?php echo $_SESSION['usuario']['name']; ?></span><br>
                <span class="idd"><?php echo $_SESSION['usuario']['email']; ?></span>
                <div class="d-flex flex-row justify-content-center align-items-center gap-2"> <span class="idd1">Oxc4c16a645_b21a</span> <span><i class="fa fa-copy"></i></span> </div>
                <div class="d-flex flex-row justify-content-center align-items-center gap-2 rounded mt-4 date " style="text-align:center;display: inline-block">Cuenta creada el: Pongan fecha alta en la db </div>
            </div>
            <div class="ff3" style="border-left:1px solid #333; padding-left:75px; margin-left:-100px;">
                <div class="d-flex flex-row align-items-center mt-3"> <span class="number">Mis datos:</span> </div>
                <table>
                    <tr>
                        <th>
                            <div class="d-flex flex-row mt-3" style="margin-left:70px;"> <span class="number">▸ Clases inscriptas: </div>
                        </th>
                        <th>
                            <div class="d-flex flex-row mt-3" style="margin-left:30px;"><span class="number"><?php echo $clses['cic']; ?></span></div>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <div class="d-flex flex-row mt-3" style="margin-left:70px;"> <span class="number">▸ Clases creadas: </span></div>
                        </th>
                        <th>
                            <div class="d-flex flex-row mt-3" style="margin-left:30px;"><span class="number"><?php echo $clses2['ce']; ?></span></div>
                        </th>
                    </tr>
                </table>
                <div class="d-flex flex-row align-items-center mt-3"> <span class="number">Descripción:</span> </div>
                <div class="text mt-3"><span>DescripciónDescripciónDescripciónDescripciónDescripciónDescripción<br>DescripciónDescripciónDescripciónDescripciónDescripciónDescripción</span></div>
                <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center"> <span><i class="fa fa-twitter"></i></span> <span><i class="fa fa-facebook-f"></i></span> <span><i class="fa fa-instagram"></i></span> <span><i class="fa fa-linkedin"></i></span><i class="fa fa-whatsapp"></i> </div>

            </div>




            <div class="modal fade" id="editPhoto" tabindex="-1" role="dialog" aria-labelledby="editPhotoLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPhotoLabel">Editar foto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div style="border-bottom: 1px solid black;border-top: 1px solid black;">
                                <div>
                                    <div class="Height">
                                        <form method="post" class="option-form" style="user-select:none">
                                            <br>
                                            <input type="image" src="img/foto-perfil/blank.png" class="void" disabled>
                                            <label class="lbl">Useless</label>
                                        </form>
                                    </div>
                                    <div style="display: inline-block;">
                                        <form method="post" class="option-form">
                                            <input type="hidden" name="alumno" value="alumno.jpg" class="Height">
                                            <input title="Set this image as profile photo" type="image" id="alumno" class="option-photo" name="alumno" value="alumno.jpg" alt="Login" src="img/foto_perfil/alumno.jpg">
                                            <label style="display: block; text-align: center;">Alumno 1</label>
                                        </form>
                                    </div>
                                    <div style="display: inline-block;">
                                        <form method="post" class="option-form">
                                            <input type="hidden" name="alumno2" value="alumno2.png" class="Height">
                                            <input title="Set this image as profile photo" type="image" id="alumno2" class="option-photo" name="alumno2" value="alumno2.png" alt="Login" src="img/foto_perfil/alumno2.png">
                                            <label style="display: block; text-align: center;">Alumno 2</label>
                                        </form>
                                    </div>
                                    <div>
                                        <div class="Height">
                                            <form method="post" class="option-form" style="user-select:none">
                                                <br>
                                                <input type="image" src="img/foto_perfil/blank.png" class="void" disabled>
                                                <label class="lbl">Useless</label>
                                            </form>
                                        </div>
                                        <div style="display: inline-block;">
                                            <form method="post" class="option-form">
                                                <input type="hidden" name="alumno3" value="alumno3.png" class="Height">
                                                <input title="Set this image as profile photo" type="image" id="alumno3" class="option-photo" name="alumno3" value="alumno3.png" alt="Login" src="img/foto_perfil/alumno3.png">
                                                <label style="display: block; text-align: center;">Alumno 3</label>
                                            </form>
                                        </div>
                                        <form method="post" class="option-form">
                                            <input type="hidden" name="eve" value="eve.jpg" class="Height">
                                            <input title="Set this image as profile photo" type="image" id="eve" class="option-photo" name="eve" value="eve.jpg" alt="Login" src="img/foto_perfil/eve.jpg">
                                            <label style="display: block; text-align: center;">Alumno 4</label>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function atvImg(){
	var d = document,
		de = d.documentElement,
		bd = d.getElementsByTagName('body')[0],
		htm = d.getElementsByTagName('html')[0],
		win = window,
		imgs = d.querySelectorAll('.atvImg'),
		totalImgs = imgs.length,
		supportsTouch = 'ontouchstart' in win || navigator.msMaxTouchPoints;

	if(totalImgs <= 0){
		return;
	}

	for(var l=0;l<totalImgs;l++){

		var thisImg = imgs[l],
			layerElems = thisImg.querySelectorAll('.atvImg-layer'),
			totalLayerElems = layerElems.length;

		if(totalLayerElems <= 0){
			continue;
		}

		while(thisImg.firstChild) {
			thisImg.removeChild(thisImg.firstChild);
		}
	
		var containerHTML = d.createElement('div'),
			shineHTML = d.createElement('div'),
			shadowHTML = d.createElement('div'),
			layersHTML = d.createElement('div'),
			layers = [];

		thisImg.id = 'atvImg__'+l;
		containerHTML.className = 'atvImg-container';
		shineHTML.className = 'atvImg-shine';
		shadowHTML.className = 'atvImg-shadow';
		layersHTML.className = 'atvImg-layers';

		for(var i=0;i<totalLayerElems;i++){
			var layer = d.createElement('div'),
				imgSrc = layerElems[i].getAttribute('data-img');

			layer.className = 'atvImg-rendered-layer';
			layer.setAttribute('data-layer',i);
			layer.style.backgroundImage = 'url('+imgSrc+')';
			layersHTML.appendChild(layer);

			layers.push(layer);
		}

		containerHTML.appendChild(shadowHTML);
		containerHTML.appendChild(layersHTML);
		containerHTML.appendChild(shineHTML);
		thisImg.appendChild(containerHTML);

		var w = thisImg.clientWidth || thisImg.offsetWidth || thisImg.scrollWidth;
		thisImg.style.transform = 'perspective('+ w*3 +'px)';

		if(supportsTouch){
			win.preventScroll = false;

	        (function(_thisImg,_layers,_totalLayers,_shine) {
				thisImg.addEventListener('touchmove', function(e){
					if (win.preventScroll){
						e.preventDefault();
					}
					processMovement(e,true,_thisImg,_layers,_totalLayers,_shine);		
				});
	            thisImg.addEventListener('touchstart', function(e){
	            	win.preventScroll = true;
					processEnter(e,_thisImg);		
				});
				thisImg.addEventListener('touchend', function(e){
					win.preventScroll = false;
					processExit(e,_thisImg,_layers,_totalLayers,_shine);		
				});
	        })(thisImg,layers,totalLayerElems,shineHTML);
	    } else {
	    	(function(_thisImg,_layers,_totalLayers,_shine) {
				thisImg.addEventListener('mousemove', function(e){
					processMovement(e,false,_thisImg,_layers,_totalLayers,_shine);		
				});
	            thisImg.addEventListener('mouseenter', function(e){
					processEnter(e,_thisImg);		
				});
				thisImg.addEventListener('mouseleave', function(e){
					processExit(e,_thisImg,_layers,_totalLayers,_shine);		
				});
	        })(thisImg,layers,totalLayerElems,shineHTML);
	    }
	}

	function processMovement(e, touchEnabled, elem, layers, totalLayers, shine){

		var bdst = bd.scrollTop || htm.scrollTop,
			bdsl = bd.scrollLeft,
			pageX = (touchEnabled)? e.touches[0].pageX : e.pageX,
			pageY = (touchEnabled)? e.touches[0].pageY : e.pageY,
			offsets = elem.getBoundingClientRect(),
			w = elem.clientWidth || elem.offsetWidth || elem.scrollWidth,
			h = elem.clientHeight || elem.offsetHeight || elem.scrollHeight,
			wMultiple = 320/w,
			offsetX = 0.52 - (pageX - offsets.left - bdsl)/w,
			offsetY = 0.52 - (pageY - offsets.top - bdst)/h,
			dy = (pageY - offsets.top - bdst) - h / 2,
			dx = (pageX - offsets.left - bdsl) - w / 2,
			yRotate = (offsetX - dx)*(0.07 * wMultiple),
			xRotate = (dy - offsetY)*(0.1 * wMultiple),
			imgCSS = 'rotateX(' + xRotate + 'deg) rotateY(' + yRotate + 'deg)',
			arad = Math.atan2(dy, dx),
			angle = arad * 180 / Math.PI - 90;

		if (angle < 0) {
			angle = angle + 360;
		}

		if(elem.firstChild.className.indexOf(' over') != -1){
			imgCSS += ' scale3d(1.07,1.07,1.07)';
		}
		elem.firstChild.style.transform = imgCSS;
		
		shine.style.background = 'linear-gradient(' + angle + 'deg, rgba(255,255,255,' + (pageY - offsets.top - bdst)/h * 0.4 + ') 0%,rgba(255,255,255,0) 80%)';
		shine.style.transform = 'translateX(' + (offsetX * totalLayers) - 0.1 + 'px) translateY(' + (offsetY * totalLayers) - 0.1 + 'px)';	

		var revNum = totalLayers;
		for(var ly=0;ly<totalLayers;ly++){
			layers[ly].style.transform = 'translateX(' + (offsetX * revNum) * ((ly * 2.5) / wMultiple) + 'px) translateY(' + (offsetY * totalLayers) * ((ly * 2.5) / wMultiple) + 'px)';
			revNum--;
		}
	}

	function processEnter(e, elem){
		elem.firstChild.className += ' over';
	}

	function processExit(e, elem, layers, totalLayers, shine){

		var container = elem.firstChild;

		container.className = container.className.replace(' over','');
		container.style.transform = '';
		shine.style.cssText = '';
		
		for(var ly=0;ly<totalLayers;ly++){
			layers[ly].style.transform = '';
		}

	}

}

atvImg();
</script>