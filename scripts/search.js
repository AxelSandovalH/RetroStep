$(function(){
    // EJEMPLO EN EL QUE SE REFLEJA TODO LO QUE ESCRIBE EL USUARIO Y SE ACTUALIZA EN INPUT DE LA NAVBAR
    // A través del input con id = "search", en cada tecleo ("keyup") hará una función
    $('#search-input').keyup(function(e) {
       
       if($('#search-input').val()){
       
            // Se guarda el valor (val) del input en una variable para mostrarla en la consola 
            let search = $('#search-input').val()
       
            $.ajax({
                url: 'scripts/sneaker-search.php',
                type: 'POST',
                data: { search },
                success: function(response) {
                        let sneakers = JSON.parse(response);
                        console.log(sneakers);
                        // let template = '';
                        // sneakers.forEach(sneaker => {
                        //     template += `<li>
                        //         ${sneaker.name}
                        //     </li>`
                        // });

                        // $('#container').html(template);
                        // $('#task-result').show()
                },
                error: function(error) {
                    console.log(error);
                }

            })

        }
    })
})