const fs = require('fs');
const path = require('path');

let data = { };
let files = [];

fs.readdirSync("./icons").forEach(file => {
    let s = path.basename(file, ".svg").split('_');

    const xml = fs.readFileSync("./icons/" + file).toString();
    const author = xml.match(/Created by ([^<]+)/i)[1];

    files.push({
        name: capitalizeFirst(s[1]),
        filename: file,
        id: s[2],
        url: `https://thenounproject.com/browse/?q=${s[1]}&i=${s[2]}`,
        author: author
    });
});

data.icons = files;

console.log(data);

fs.writeFileSync("icons.json", JSON.stringify(data, null, 4));

function capitalizeFirst(s) {
    return s.charAt(0).toUpperCase() + s.slice(1);
}
