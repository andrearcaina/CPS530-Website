function validateForm() {
    const name = document.getElementById("name").value;
    const address = document.getElementById("address").value;
    const phone = document.getElementById("phone").value;
    const NameFormat = /^[A-Za-z]+[A-Za-z]+$/;
    const PhoneFormat = /^\(\d{3}\) \d{3}-\d{4}$/;

    if (phone.match(PhoneFormat) && !name.match(NameFormat)) {
        alert("Name can only contain letters and spaces.");
        return;
    }

    else if (!phone.match(PhoneFormat) && name.match(NameFormat)) {
        alert("Phone number must be in the format (416) 555-5555.");
        return;
    }

    else if (!phone.match(PhoneFormat) && !name.match(NameFormat)) {
        alert("Name can only contain letters and spaces.\nPhone number must be in the format (416) 555-5555.");
        return;
    }

    else {
        let newPhone = phone.replace("(", "").replace(")", "").replace(" ", "-");
        
        const output = document.getElementById("output");
            output.innerHTML = `
                <h2>User Information</h2>
                <p>Name: ${name}</p>
                <p>Address: ${address}</p>
                <p>Phone Number: ${newPhone}</p>
            `;

        document.getElementById("userForm").reset();
    }
}

function countText(){
    const text = document.getElementById("count-textarea").value;
    const charCount = document.getElementById('charCount');
    const letterCount = document.getElementById('letterCount'); 

    charCount.innerHTML = text.length;
    letterCount.innerHTML = text.replace(/[^A-Za-z]/g, "").length;
}

function createBookmarkList() {
    const bookmarkList = document.getElementById("bookmarkList");
    const bookmarks = [
        { link: "https://www.youtube.com/", secure: true },
        { link: "http://icio.us/", secure: false }
    ];
    
    if (bookmarkList.innerHTML === "") {
        for (let i = 0; i < bookmarks.length; i++) {
            let isSecure = "";
            let secureText = "";

            if (bookmarks[i].secure) {
                isSecure = "secured-icon";
                secureText = "🔒";
            } else {
                isSecure = "unsecured-icon";
                secureText = "🔓";
            }

            const item = document.createElement("p");
            item.innerHTML = `
                <span class="${isSecure}">${secureText}
                    <a href="${bookmarks[i].link}" target="_blank">${bookmarks[i].link}</a>
                </span>
            `;

            bookmarkList.appendChild(item);
        }
    }
}