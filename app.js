

function payWithPaystack() {


    

    var handler = PaystackPop.setup({ 
        key: 'Your Paystack public key', //put your public key here
        email: 'customer@email.com', //put your customer's email here
        amount: 370000, //amount the customer is supposed to pay in kobo
        metadata: {
            custom_fields: [
                {
                    display_name: "Mobile Number",
                    variable_name: "mobile_number",
                    value: "+2348012345678" //customer's mobile number
                }
            ]
        },
        callback: function (response) {
            //after the transaction have been completed
            //make post call  to the server with to verify payment 
            //using transaction reference as post data


            $.post("verify.php", {reference:response.reference}, function(res){

                if(res == "success"){
                     //successful transaction
                    alert('Transaction was successful');                   
                }

                else{
                    //transaction failed
                   console.log(response); 
                }
            });
        },
        onClose: function () {
            //when the user close the payment modal
            alert('Transaction cancelled');
        }
    });
    handler.openIframe(); //open the paystack's payment modal
}
