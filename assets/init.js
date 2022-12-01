window.addEventListener("load", (e) => {
    document.querySelectorAll("button[data-dropdown-trigger]").forEach(e => {
        // console.log(e);

        const { dropdownTrigger } = e.dataset;

        e.addEventListener("click", (e) => {
            //console.log(e);
            dropdownOpen(dropdownTrigger, e.pageX, e.pageY);
        });
    })
});

function dropdownOpen(id, x = null, y = null) {
    return new Promise((res, rej) => {

        // alert("lol");

        let abort = new AbortController();

        let dropdown = document.querySelector(".dropdown[data-dropdown-id='" + id + "']");

        dropdown.querySelectorAll(".dropdown .entry[data-action-id]").forEach(entry => {
            entry.addEventListener("click", (event) => {
                // alert("Click");
                // const { dropdownId } = entry.dataset;
                dropdown.classList.remove("show");
                // closeDropdownById(dropdownId);
                // console.log(entry.dataset);
                res(entry.dataset);
                abort.abort();
            }, {
                signal: abort.signal
            });
        });
        
        dropdown.querySelector(".dropdown .background")
        .addEventListener("click", (event) => {
            // closeDropdownById(dropdownId);
            dropdown.classList.remove("show");
            rej();
            abort.abort();
        }, {
            signal: abort.signal
        });

        let left, top;

        if (window.innerWidth < dropdown.offsetWidth + x + dropdown.clientWidth) {
            left = window.innerWidth - dropdown.offsetWidth;
        } else {
            left = x;
        }
    
        if (window.innerHeight < dropdown.offsetHeight + y + dropdown.clientHeight) {
            top = window.innerHeight - dropdown.offsetHeight;
        } else {
            top = y;
        }
    
        // let left = window.innerWidth - dropdown.clientWidth - x;
        // let top = window.innerHeight - dropdown.clientHeight - y;
    
        console.log(x, y);

        if (x && y) {
            dropdown.style.left = left + "px";
            dropdown.style.top = top + "px";
        }

        dropdown.classList.add("show");
    })
}

function getClickContext(event) {
    console.log(event);
}

function closeDropdownById(id) {
    document.querySelector(".dropdown[data-dropdown-id=" + id + "]").classList.remove("show");
}

// function showDropdown