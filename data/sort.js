const fs = require("fs");

fs.readFile("spec.json", "utf8", function (err, data) {
	if (err) {
		console.error(err);
		return;
	}
	let datas = JSON.parse(data);
	let json = datas.sort();
	let toJson = JSON.stringify(json);
	console.log(toJson);
});