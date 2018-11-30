function Tabs(perm, active_idx) {
    var user = JSON.parse(localStorage.getItem('user'));
    var tabs;
    if (perm == 3) {
        tabs = [
                    {
                        title: "Dashboard",
                        icon: "users",
                        link: './dashboard-sales.html'
                    },
                   {
                       title: "Orders",
                       icon: "users",
                       link: './dashboard-sales.html'
                   },
                   {
                       title: "Comments",
                       icon: "users",
                       link: '#'
                   },
                   {
                       title: "Sales Info",
                       icon: "users",
                       link: './dashboard-admin.html'
                   },
                   {
                       title: "Customers Info",
                       icon: "users",
                       link: './dashboard-admin.html'
                   }
               ];
    } else if (perm == 2) {
        tabs = [
                   {
                       title: "Comments",
                       icon: "users",
                       link: './dashboard-sales.html?sales_id='+user['data']['sales_id']
                   },
                   {
                       title: "Orders",
                       icon: "users",
                       link: './orders-list.html?sales_id='+user['data']['sales_id']
                   },
                   {
                       title: "Customers Info",
                       icon: "users",
                       link: './customers-list.html?sales_id='+user['data']['sales_id']
                   }
               ];
    } else if (perm == 1) {
        tabs = [
                   {
                       title: "Comments",
                       icon: "users",
                       link: './dashboard-sales.html?customer_id='+user['data']['customer_id']
                   },
                   {
                       title: "Orders",
                       icon: "users",
                       link: '#'//'./dashboard-sales.html?customer_id='+user['data']['customer_id']
                   },
                   {
                       title: "Customers Info",
                       icon: "users",
                       link: '#'//'./customers-list.html?customer_id='+user['data']['customer_id']
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
