function idCard(){
    var postFullName=document.getElementById('fullName').innerHTML;
    var age=document.getElementById('age').innerHTML;
    var phoneNumber=document.getElementById('phoneNumber').innerHTML;
    var type=document.getElementById('type').innerHTML;
    var numberArray = [];
    numberArray.push(age, phoneNumber)
    console.log(postFullName, age, type);
    document.getElementById('postFullName').innerHTML=postFullName;
    for (var i = 0; i < numberArray.length; i++) {
        if (numberArray[i] <= 100) {
            document.getElementById('postAge').innerHTML="Age: " + age;
        } else if (numberArray[i] > 100) {
            document.getElementById('postPhoneNumber').innerHTML="Tél: " + phoneNumber;
        }
    }
    document.getElementById('postType').innerHTML=type;
}
