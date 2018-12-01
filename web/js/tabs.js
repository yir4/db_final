function Tabs(perm, active_idx) {
    var user = JSON.parse(localStorage.getItem('user'));
    var tabs;
    if (perm == 3) {
        tabs = [
                    {
                        title: "Dashboard",
                        icon: "home",
                        link: './dashboard-sales.html'+user['data']['user_id']
                    },
                   {
                       title: "Orders",
                       icon: "shopping-cart",
                       link: './dashboard-sales.html'+user['data']['user_id']
                   },
                   {
                       title: "Comments",
                       icon: "message-square",
                       link: './dashboard-admin.html'+user['data']['user_id']
                   },
                   {
                       title: "Sales Info",
                       icon: "user-check",
                       link: './dashboard-admin.html'+user['data']['user_id']
                   },
                   {
                       title: "Customers Info",
                       icon: "users",
                       link: './dashboard-admin.html'+user['data']['user_id']
                   }
               ];
    } else if (perm == 2) {
        tabs = [
                   {
                       title: "Comments",
                       icon: "message-square",
                       link: './dashboard-sales.html?sales_id='+user['data']['sales_id']
                   },
                   {
                       title: "Orders",
                       icon: "shopping-cart",
                       link: './orders-list.html?sales_id='+user['data']['sales_id']
                   },
                   {
                       title: "Customers Info",
                       icon: "users",
                       link: './customers-list.html?sales_id='+user['data']['sales_id']
                   }
               ];
    } else if (perm == 1) {
        tabs = [    {
                        title: "Comments",
                        icon: "message-square",
                        link: './dashboard-sales.html?customer_id='+user['data']['customer_id']
                    },
                   {
                       title: "Order Now",
                       icon: "shopping-cart",
                       link: './dashboard-sales.html?customer_id='+user['data']['customer_id']
                   },
                   {
                       title: "Order History",
                       icon: "folder",
                       link: './dashboard-sales.html?customer_id='+user['data']['customer_id']
                   },
                   {
                       title: "My Info",
                       icon: "user",
                       link: './customers-list.html?customer_id='+user['data']['customer_id']
                   }
               ];
    } else {
        // exit this application
    }

    var ul=document.createElement('ul');
    ul.className = "nav flex-column";
    for(i=0;i<tabs.length;i++)
    {
        var li=document.createElement('li');
        li.className = "nav-item";
        console.log(active_idx);
        if (i == active_idx) {
            li.innerHTML="<a class=\"nav-link active\" href="+tabs[i].link+"><span data-feather="+tabs[i].icon+"></span>"+tabs[i].title+"</a>";
        } else {
            li.innerHTML="<a class=\"nav-link\" href="+tabs[i].link+"><span data-feather="+tabs[i].icon+"></span>"+tabs[i].title+"</a>";
        }
        ul.appendChild(li);
    }
    document.getElementById('side-menu').appendChild(ul);

    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    }
}
