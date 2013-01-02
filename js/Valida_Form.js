$().ready(function() {
$("#Nuevo_Viaje").validate(
{
		rules:
		{
			Tipo_Usuario_Viaje: "required",
			Punto_Salida:
			{
			required: true
			},
			Punto_Destino:
			{
			required: true
			},
			Fecha_Viaje:
			{
			required: true
			},
			Hora_Viaje:
			{
			required: true
			},
			Costo: "required",
			Pasajeros: "required",
			Redondo: "required",
			Privado: "required",
			EmailAmigo:
			{
				required: true,
				email: true
			},			
},
	messages:
	{
			Tipo_Usuario_Viaje : "Es necesario que nos indiques esta parte.",
			Punto_Salida : "Indica de donde vas a salir.",
			Punto_Destino : "Indica hacia donde vas a.",
			Fecha_Viaje : "Indica tu fecha de salida.",
			Hora_Viaje : "Indica tu hora de salida."
	}
});

	$("#Usuario").focus(function() {
		var Apellido_Paterno = $("#Apellido_Paterno").val();
		var Apellido_Materno = $("#Apellido_Materno").val();
		if(Apellido_Materno && Apellido_Materno && !this.value) {
			this.value = Apellido_Paterno + "." + Apellido_Materno;
		}
	});

	var newsletter = $("#newsletter");
	
	var inital = newsletter.is(":checked");
	var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
	var topicInputs = topics.find("input").attr("disabled", !inital);
	
	newsletter.click(function() {
		topics[this.checked ? "removeClass" : "addClass"]("gray");
		topicInputs.attr("disabled", !this.checked);
	});
});

$().ready(function() {
$("#Punto_Salida").validate(
{
		rules:
		{
			Punto_Salida: "required",
			Pais: "required"
		}
});
});
