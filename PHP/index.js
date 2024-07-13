var valider = document.getElementById('valider') ;
var form = document.getElementById('form') ;
valider.addEventListener('click' , function(event){
    if(window.confirm('voulez-vous confirmer'))
        {
            valider.name = 'valider' ;
        }
})