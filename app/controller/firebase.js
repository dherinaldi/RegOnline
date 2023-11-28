var firebaseConfig = {
	apiKey: "AIzaSyAWz1IY-LtLxK_iT7E8d-T_IjHB5JF5G3o",
	authDomain: "antrianonline-f343e.firebaseapp.com",
	projectId: "antrianonline-f343e",
}
firebase.initializeApp(firebaseConfig)
const db = firebase.firestore()
var tglNow = $("#tglNow").val();
db.collection("data").doc('A').onSnapshot(doc => {
	if (doc.exists) {
		if(doc.data().tanggal == tglNow){
			document.getElementById('Pos-A').innerHTML = doc.data().nomor
		} else {
			document.getElementById('Pos-A').innerHTML = '0'
		}
	} else {
		document.getElementById('Pos-A').innerHTML = '0'
	}
})

db.collection("data").doc('B').onSnapshot(doc => {
	if (doc.exists) {
		if(doc.data().tanggal == tglNow){
			document.getElementById('Pos-B').innerHTML = doc.data().nomor
		} else {
			document.getElementById('Pos-B').innerHTML = '0'
		}
	} else {
		document.getElementById('Pos-B').innerHTML = '0'
	}
})

db.collection("data").doc('C').onSnapshot(doc => {
	if (doc.exists) {
		if(doc.data().tanggal == tglNow){
			document.getElementById('Pos-C').innerHTML = doc.data().nomor
		} else {
			document.getElementById('Pos-C').innerHTML = '0'
		}
	} else {
		document.getElementById('Pos-C').innerHTML = '0'
	}
})

db.collection("data").doc('D').onSnapshot(doc => {
	if (doc.exists) {
		if(doc.data().tanggal == tglNow){
			document.getElementById('Pos-D').innerHTML = doc.data().nomor
		} else {
			document.getElementById('Pos-D').innerHTML = '0'
		}
	} else {
		document.getElementById('Pos-D').innerHTML = '0'
	}
})