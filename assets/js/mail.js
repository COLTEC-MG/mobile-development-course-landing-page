$('#contact').submit(function(event) {
    event.preventDefault();
    console.log('enviando e-mail...');
    
    let sendObject = {};
    let self = this;

    $(this).serializeArray().forEach(function(element) {
        sendObject[element.name] = element.value;
    });

    $.post("mail.php", sendObject)
    .done(function(data) {
        alert("E-mail enviado com sucesso.");
        console.log('email enviado com sucesso!');
        $(self).trigger('reset');
    })
    .fail(function(data) {
        alert("Problema no envio do e-mail. Tente novamente mais tarde");
        console.log('problema no envio do e-mail');
    });
});