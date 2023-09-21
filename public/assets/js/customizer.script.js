$(document).ready(function() {
    var $appAdminWrap = $(".app-admin-wrap");
    var $html = $("html");
    var $body = $("body");
    var $customizer = $(".customizer");
    var $sidebarColor = $(".sidebar-colors a.color");

    // Change sidebar color
    $sidebarColor.on("click", function(e) {
        e.preventDefault();
        $appAdminWrap.removeClass(function(index, className) {
            return (className.match(/(^|\s)sidebar-\S+/g) || []).join(" ");
        });
        $appAdminWrap.addClass($(this).data("sidebar-class"));
        $sidebarColor.removeClass("active");
        $(this).addClass("active");
    });

    // Change Direction RTL/LTR
    $("#rtl-checkbox").change(function() {
        if (this.checked) {
            $html.attr("dir", "rtl");
        } else {
            $html.attr("dir", "ltr");
        }
    });

    // Dark version
    $("#dark-checkbox").change(function() {
        if (this.checked) {
            $body.addClass("dark-theme");
        } else {
            $body.removeClass("dark-theme");
        }
    });

    let $themeLink = $("#gull-theme");
    //   initTheme("gull-theme");

    //   function initTheme(storageKey) {
    //     if (!localStorage) {
    //       return;
    //     }
    //     let fileUrl = localStorage.getItem(storageKey);
    //     if (fileUrl) {
    //       $themeLink.attr("href", fileUrl);
    //     }
    //   }

    $(".bootstrap-colors .color").on("click", function(e) {
        e.preventDefault();
        let color = $(this).attr("title");
        console.log(color);
        let fileUrl = "assets/styles/css/themes/" + color + ".min.css";
        if (localStorage) {
            gullUtils.changeCssLink("gull-theme", fileUrl);
        } else {
            $themeLink.attr("href", fileUrl);
        }
    });

    // Toggle customizer
    $(".handle").on("click", function(e) {
        $customizer.toggleClass("open");
    });
});

// $.extend($.fn.dataTable.defaults, {
//     buttons: {
//       buttons: [
//         {
//             extend: 'pdf',
//             exportOptions: {
//               columns: [ 1, 2, 3, 4, 5, 6, 7 ],
//                 modifier: {
//                     page: 'current'
//                 }
//             },
//             filename: 'certificados',
//             orientation: 'landscape', //portrait
//             customize: function ( doc ) {
//               doc.styles= {
//                 tableHeader: {
//                     fillColor: "#146CC8",
//                     color: "white",
//                     fontSize: 12,
//                     alignment: "center"
//                 },
//               },
//               doc.content[1].table.widths = ['10%','20%','10%','10%','20%',  '15%', '15%'];
//                 // Splice the image in after the header, but before the table
//               doc.content.splice( 1, 0, {
//                   margin: [ 0, 0, 0, 12 ],
//                   alignment: 'center',
//                   image: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUAAAABUCAYAAADzoO6TAAABN2lDQ1BBZG9iZSBSR0IgKDE5OTgpAAAokZWPv0rDUBSHvxtFxaFWCOLgcCdRUGzVwYxJW4ogWKtDkq1JQ5ViEm6uf/oQjm4dXNx9AidHwUHxCXwDxamDQ4QMBYvf9J3fORzOAaNi152GUYbzWKt205Gu58vZF2aYAoBOmKV2q3UAECdxxBjf7wiA10277jTG+38yH6ZKAyNguxtlIYgK0L/SqQYxBMygn2oQD4CpTto1EE9AqZf7G1AKcv8ASsr1fBBfgNlzPR+MOcAMcl8BTB1da4Bakg7UWe9Uy6plWdLuJkEkjweZjs4zuR+HiUoT1dFRF8jvA2AxH2w3HblWtay99X/+PRHX82Vun0cIQCw9F1lBeKEuf1UYO5PrYsdwGQ7vYXpUZLs3cLcBC7dFtlqF8hY8Dn8AwMZP/fNTP8gAAAAJcEhZcwAALiMAAC4jAXilP3YAAAUVaVRYdFhNTDpjb20uYWRvYmUueG1wAAAAAAA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA2LjAtYzAwMiA3OS4xNjQzNTIsIDIwMjAvMDEvMzAtMTU6NTA6MzggICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIiB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdEV2dD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlRXZlbnQjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCAyMS4xIChXaW5kb3dzKSIgeG1wOkNyZWF0ZURhdGU9IjIwMjEtMTEtMTFUMTc6MDU6NTYtMDU6MDAiIHhtcDpNb2RpZnlEYXRlPSIyMDIxLTExLTExVDE3OjA2OjEyLTA1OjAwIiB4bXA6TWV0YWRhdGFEYXRlPSIyMDIxLTExLTExVDE3OjA2OjEyLTA1OjAwIiBkYzpmb3JtYXQ9ImltYWdlL3BuZyIgcGhvdG9zaG9wOkNvbG9yTW9kZT0iMyIgcGhvdG9zaG9wOklDQ1Byb2ZpbGU9IkFkb2JlIFJHQiAoMTk5OCkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6YzgwYzY4ZTItZDFmNy0xNjQ2LWFmNzEtZWY5Zjk1YjQxYzBmIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOmM4MGM2OGUyLWQxZjctMTY0Ni1hZjcxLWVmOWY5NWI0MWMwZiIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ4bXAuZGlkOmM4MGM2OGUyLWQxZjctMTY0Ni1hZjcxLWVmOWY5NWI0MWMwZiI+IDx4bXBNTTpIaXN0b3J5PiA8cmRmOlNlcT4gPHJkZjpsaSBzdEV2dDphY3Rpb249ImNyZWF0ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6YzgwYzY4ZTItZDFmNy0xNjQ2LWFmNzEtZWY5Zjk1YjQxYzBmIiBzdEV2dDp3aGVuPSIyMDIxLTExLTExVDE3OjA1OjU2LTA1OjAwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjEuMSAoV2luZG93cykiLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+WGFA2wAAJLNJREFUeJztnXd4HNW5uN/ZJsmq7rIlF5qxqabFlNAx4ZJw6TdOAj/aDS2hhEuPDYEABgNJyCX3hhIghEAumFBMqLYJxWAgYGMMprh3uaNqld35/fHNeFer3TlnykoyzPs8+6y9e2bm7Gjmm68fg1NX0supBvYC9gBGAbVADdAfKANMoBHYAKwCVgBfAp8C84B13T/lkJCQ3o45tYZYT08iD6OAHwCnAAcACcX4fsBwYN+sz7cCs4GpwIvAkmCnGRISsj3T2wTgqcBFwNEB7a8YOMJ6AbwM3Av8I6D9h4SEbMdEenoCFucAcxBNLSjhl4vjgBcQrfBHBTxOSEjIdkBPC8BDgFnAQ8DYbjzuOOBx4DW6ms0hISHfEnpSAN4BvA0c3INzOAb4EJjUg3MICQnpIXpCANYC/wKu7oFj5+Nm4J9A3x6eR0hISDfS3QLwKCQ9Zb9uPq4OhyNz+05PTyQkJKR76E4BeAowA6joxmO6ZQjwHmIah4SEfMPpLgF4MvB0gPtrAJYCC6zXcqApwP2/hmirISEhwk3IPXd8D8/DDzciv+FM+4PuyAM8GPi7z30sQtJX3gI+B1YCX2eN6Yv4F8cgeX/HAyN8HHMGEpn+2Mc+QkK+KeyA3E8DenoiPrB/Q7X9QaEF4AhEkHihA0mPeRx4Q2P8Zuv1CfAkYCA5hWcAZ3mcw5vIb9jicfuQkG8KtsLR0qOz8If9G7ZZi4U2gV9GqjHc8ghSDncBesIvFyYwHTgb2B34m4d9VOBdgIeEhPRyCqkB3geMdrnNEuBcJCUlSD5DKj8eRbTKaufhndgXuAFJlQkJ+SYxAjEL40gzkc+AVp/7HI24ogzEVbXA5/7cEEGapgwGkog8yaz/j+baoBCMA853uc3TwG4EL/wyeQnYFXjV5XY3IXMLCfkm8BOkU9JS4HXkfvgIMW//CAz0sM+rgNWIwHvN2udnwBrgmjzbnG3N4TqN/b9sjd0jx3clwN1IV6iPrWPPABYD84EJ1rgunaEKpQG6jfjeDVxZiInkoB74HnA/8FMX2z1GWDYXsv3zNJKSBlKQ8DbQjCgGpyJupzMQofGCxv4GIM1F7PzZ15C6fpB836OB261jjkfuP5shiBaqE6wci2h2pVmfH2T9piHW/59H8nmLgUOB/YEngJ3I0VWqEALwHKRfny6/ofuEXybnIyrxuZrj90EukCDTeUJCupMXgX8DFiLX/VtZ35chJaoXA9OQB/4cnHkX2BnRJC8Avsr6fnfgT4hV+DbS29PGDkbUo2YdIgDbMz6rtfYZQdxb/4WY8pkcDDwA3IIEVjsRtAkcAaa4GP8UMume4jzcBTnuKdREQkIKzH8iwm8FYkZmCz8QE/JnpO/hj3AuD70TEX6zkLzZbOEHoo0diJjGexLs/f4cInPuRzI9soUfwDuIEF5IDoUvaAF4Nvp5QkuA/wj4+F4YD2zSHFvD9p0IGvLtZbL1fgrqQMc1SLLwVeRvRlxB2nLTaS33Q+v9RiTo4hXDet8H0VBXIpqnipyFDUELwF+4GNtbBImJdJ/W5ZZCTSQkpEAcjigmCxG/nw6PAXcBdXm+P9J6fwfRKlV8ghQ0lOOvA1TKej/dev8fze1WIGlxnQhSAO5P7ghNLn6PVHT0Ft5F/uA67APsUsC5hIQEjX1fvh7gPne23t10V5+Vta0bTOs9ab2Ps951BTrkMPuDFIDnaY5rw52m2F248U2crh4SEtJrsO/zIKs47H26yRu0j2+bwHZeXirH2GzMrHe7wKJLYMOB9uwPgowCH6s57g/o/eDuZh2SJK0TFT4euK1A8xhF11C/TRJxKifzfB8SHHGcLZrNSF7a9sBa633PAPdpm8ZjXWyzg/Vu+9zt67hLgnIOKrPGfomY0iNdHL9LYUZQAnAHYEfNsYUSHEFwB3oC8GBgKJL4GTRTyX+hJpHlQLMbQYQEz2AkCpqPvyNpUdsDM633I5CkYV1N0LDGN+f4zjYnTyOju4qCw633d633Rda7yiROAMOsf9ua5wtI0PVc4GHN4/979gdBmcAHao57ndyh6t7Cl+QO5WdjAIcVaA5O2p0bdT+ksGxPWvhGxLoxrHcV+yMVFMvJnwazBBFkxcCvNPZ5E1AEvEI6aPKe9T5ese2JdNUSpyHutO+i55L6PVCV/WFQAlC3QmJ7WI7yKc1xQZoTmWx1+K6FtA8kpLCYOJ/rtu6aSEBchVxbExBLJx/fQYIVuyNa1iqHsWdY7zfibDn9BKmnB7gs4/MNiBAsJX+ObX+kOUo2bRnHf5Ic2l0GVwOX5PoiKAF4gOa42QEdr5C8pDkujASHbE9sQlw3JiIQvkIqPnZDStG+C/wvIpASSPnYRRnb27LCyPhsMen8vj8hRQWnIffGjsD3EU3NzrA4C/gia14XWu+XIsrHMYhJvDsiLDcAfUhbZpnHf4p0k5LnEAXrZMSPPgoxzd9DBP4riBbYaR9B+QB1avk6ELW6t/M5MlfVuRmm+D4kpLcxB6n5vRMxK/+QZ9xE4Nasz/pZ732yPn8SWI/kDB5F7oTjhUiWxfM5vpuLaG8PIcLztKzvk4iF+aD1/+zE7BsRuXIbEpzMlV/8MlIFYwvLbctyBCUAdao/vmD7cN5vQLLLRyrGDSr8VEJCAucr4CREqHwfieKWIlkQHyACLVfy853As0jiczavI40PjkME4BhEtixG+nk+qZjTNESJOgsxwauROuH3kUTnRsSHWEbu/OGnrNdJSAOE0YiW9wXSGca26l6yfv/79oYGp65UzC0voxF19d9ROzFBVNSTvB6sCxGg0dLKy1JBJ9bMJp1omY8konL/A8kwXxzQsd8lf1BpC3Kh6BSPh/ijBnHWG3m+/ytpH1TIdog5tcaTBngaUjB9hMvtGjwcKzdRE9bHMAYkwTAxN8agfwck812rrtGZaxQR/rbz9VXEpMil5oeEhPRC3ARBTkFUx6dwL/wgKB0tasLKBLGBHRx462rG3byGSEUSVsflu2DwsqNjES33TaTfYEhISC9HRwMsQTSbc3weK191gz5RE9bGiQ5sZ7+b1lBWK5UtYyfW8dH1Q2BdDAYlg8jQKvGx7aGI0/V/kMhWd+WL7YA4uKtJn+smJFl7IcGZ6G4oQ/LIIkhgaRM9s6jOLtarGvnbmtZcliF+It1uQIWiH9IkACRVZRM5yra6iUrrZVhz2IRzalZ3UYRcS0XW/xsI4O+mEoC7Iw7KHRTjdBiiHuKAZfaSMBn7q7VUjGinYVkCDJMBu7ew16S1zJs0BDZFoZ9vIdjf19bCxUjHjO+h1y1Dl0ytvQzp83YW6pKkBUiVyRMUbp2GQYhfeDySGlVD+mZKIj7MlcCHpNuWFyoxfk8k/+wk5MGQj0akquFRxFlvWyo65Vle2QPplHwsEjCwBTNIftsm0gGE6aQrOQrBEGse30MCI0NJC+MO5G+2zJrLP3LMpRQJfBh0tZwiSBrKWtwTJ30tfRfxffclXUfcYu33Y0RGTUOi0ZmMtbbLtj4jyG+a6xQEOQj50X56d2WyGung6t68jCKCrd1gz5tXU31ACw3L4xi2KDChfGQby6eX8/mUwVCRhCLTa8pwAhFYQUV565GqEd31hZ2CIM2ktbtzkFbjXuY5Fen5FpRWuDtwLVIa5kZ7bgKeQX7HpwHNZUck7ys7nUKHxUhaxWPIde+U7OwlCHIqktt2qMvtFiFpIHcRXDXQKCTd5T9Ia1U6fIJEZO3O6Hsi64vk4yfI0ra6lCN5im47yzchVtfVGZ89R/4E6efNqTUn5vMBjkPC3UEJP5BUmX7KUdlEgPoINEfY9co6hhzYTOPKDOFn0bAiwcjj6qmZsFk0Re/09TTP/FQgQm0v1UANViJn5B4kb8qrkD4NMf38LkVQgVx08xFh4NZ1UGptNx9ZRbDSebiSK5E0CS/CD0R4/gX4b6TEK18vPLcchCz2NRX3wg9kPYvJSApHEJHnycjf/0zcCT8QgTcV0Ziha2JzNm5cHhcjwn4i7oQfyLV0FSKM7aYHTtkSmyF3EGQI0mc/aBJ4WVW+HaiPssPF6xl5XD2NyxNdNTvLwGrZEGPYUQ0YNe3pFBn39CP4tVJKkBvArx/UNiku9Tsh5DfeSfpCdsuBiNZ2kWqgJucjq4gdrhqYh0eR3xPEQ/vnSCpUEP7bnyPKhNfflclIREDrNgHNptKay7UBzOVMxJ1ShNQa50PXDvsLEmvwsiJdJnuSbuU/12FcCnILwOkUbrU4nYqRNBFgTZyBJ2xh1ITNNK5IYKbInZllQNuWKOXD2hmwX7Nogd5koG5XG7f0RVbM8sPOSKF6kJyJ+E/ccBKi1dYGPJehyIPCrQb3FPodSXTZzZqPH36DaJNBcxHu6+qrEIFwUIDzmIBkPfgNbL1BsDmVtsKhbNKSLegm43392xWIn+tzxB7vizjpS5AnT762OrmJmrA+DqUpdjzxa9q+jpJsM7qYvtm0NxmMOK6e9TPKYUMUBrrOD2xCMtubkcqVrUjEaYv1e3ZDnKtegjoHIUXZhbgp/PADRKu4WHPsM4WdDk8BJ6C3LOM9eDd5C8lvgcsLuP/jkb/DyZrjZ+Gud54uY31uP53CdFbaCw23U6YAHIY31fh+xCH8NkHm+m2IQQrGXFdHaXUHzetjSuGHAVs3xqjcqZUxV9axYHI1bIxBf1dR4X+iXpw9gUSmzkR6krnh9+QvN/JDC2KSrkN05EFItFHXx3MRUjD+nMOYXXCvLXplGhK9/dJhzKm4cwc0Imb2BsQ+GEowvtlsLsKb8DPJX3mSi5OAScCvFeMex7tiU0imINFwt7g9T3nJFID3udx2FuLfmBvERLYRBTbFoMNgzPV1DD+6gfqlRdq/1jCguS7O8GMaAIMFt1RLUoH/1JhM2pB0gJlIdO5/cdce61YkfSUI3kc6cTyLCL9MqpGb5Fz0OvY8iZhK+UwaXRO+Afg/RJP+FHE4DyCd/nEaXYvqc/Ey+V0SEeDPmvOZjawN+xxd/VU7IZHQC3DrosnNUPR9dNMQDWg+kpbRhqRg7YS4Oo5HLaBvRs51vgfFMeit2gbiH5yGpCktQu6YauTvdhTywHEbNMnHaCRooUMdEnV+G7EwNyL+9FFI7fAJeGxPZ6fB1OIuV+0J4MdeDuhIFNgsEd8xk9Yy/OhG6pck3Mt7E4hA2fA2Vkwv5/PbBkOJGbQQzMYp5J6LGnJ3lHZKg8nmWpx7u2VyBXC3xrhfIWkO2VxP1w4huXgISbFxyu8bgvjHJmjs75fk7iJ+G3CdxvaXkW6D5ETMGqcb1MmXBvMGapNuJqK56qT+nIkI1DKHMW+SP8iyDBiuOMZGpC3VVMW4GiQVR+fvZnMy8nDO5h30/JF3IBpuk2LcWcC9OJ+nTB42p9acaxuVlzkO7cw0CiL8TNgYFeE3cS21RzRSv9SD8MMan4LG5aIJjr6+DloM2X9w5XLZnIi7hNXzfR7vNPSFH4jA0RHQl+f4rBI94XcusjiWKrl5DaKV5DpWNjfQ1VddhAhZFcegJ/xA8usuRl8rycUhqIXfnxAtWDfv8S+I+eqUTHwYuZeaPBy18LMXSlcJP5DmqD9C78HjxEHoCb/jkYe8SviBWAOjcblOSwQRF7rm2FLcaTl6RBFfXYfBmIl1DDuykaaVCfEoerX0DSBl0LA8IULwl3XQboh5Xbgc/+PQb/rgZ1H4a0gnorphGuK2cKIKSV7NRGfh6QvRX5vB5h7UuYhFdH1An4Y6xn86UmnilrsQl4YXVILhDby5Plag9pXlUmJUik0KEZxuKzVuR8+ayMeF6iGciH5zYptVyO/R7pYUQWzoKs3xOgsGuSMKbIpAq8Hoq+sYPr6ehhUJzCT+3ZyWJtiwPMGI8fWMubYOWiJSVVIYIdgO/FRz7Bi8NVWdhziPvfIH0uuz5iM7qpqznXgG03DvQ7a5GxEMTmSbpSohMgM9jSYfF+NeKNQg/fXy0UG6e7IXPkMiy/n4AZ1zICtQt5+bhCTXe+FKj9vGUCtRj+G9q9Iauj7A8xJBopk6vEewCyt38vmNvq6O4cc0UL+4yJ/ml40lBOuXFlF7dAOjr1sLWyOwuTjYVZHTODmks/ES/s/ln3PLDYrvv5Px7wNwzvdL4r9RhioHbCfS9ehlqM9bEMnZN6uHdOIExffX4z/yfwX5zcE+iAViczDOd9EW/K/Q6GYtbZsjUCtcXvabyQtodp+PIXWcOnjNPs9N1IT1CWiF0RPXMvyoBhqWxwMMcGeQ6RMc30Ai1cG8e0dBfRWUrwLT9gQExqPALRrjDkOc6bpsxb1ZkIuZWLHxPN8PRXxHy1E/IJ/GuRJAh5WIVnqIw5gDkZXI9sL50TUXvZX9VPwJqSzRrd5RRdn3QOqM/VxoLchC5PnmdDjpNCVVVNQp3UmXp5DzpBt4APV5eoau2QxemIJGlVMM/cqHt9RDNImasLoMitoZc8NKao9optGvz0+F5RPcuKoPgw9v4u1lF3Prq2fyUtN46LOSgCWvrqasWg81mw8Jrp3UmzibSCMQAajKHwuqAezjOAvAvZHsg50U+wmqc0obIpSP1Rzv1HEG4P/5m44WmdfTSMVYlRtEBxPJWtDpCG+jkjdBrRypdQ9G0Mt9Woc8ff0TMWFFFYnh6zjgd69Qe1gjjSuKg/H5qTAglYqwemM/Dimdw4v7TGDfyrnQbFt4gUWI56EXuXLbdmuReog2Hyi+t7VDVTnYZwHMBdQ3pG2pqGpFgzxHudafyIe/dm/BkDkHVd19UJ2A3LZWG6z43s05d2Il4g90JELGCkkOeOnnleNoJqyqIjFiI/vf+jxVO62jYXlpYTW/LAzDJEaSzxt3hUgLH4w9nbG2EDQCE4CNSP6VCp1k4EyCXAsku3daNnZnFpUJuMX/VLT2U2W9Z68Klo3Og0cX3UW8YvhrohsUmfey6jwFtUCZ26akqms+yP6QSrml6/zyX+IWMWF5X+IjNrH/7c9T0q+ZhmUDpLytm4QfgGGadESiRCImtAwjEt3K+2NPZ5+qudA4DIwUAWmCOinXbn95kE0qVPvSvaEL2Tg0E/tcqa7F4gCP6eZ8d+NVnJfM+arOU1DLiLm9WVTnKah+h6BxD8YQbaWvYpz7NlY29s9d3J/i3dayz80vUNK3iabVlRjRJBK577Dmmvfc9Eed0GmzijxO1IiZYmsswabiCuJmEiJJ2DqMeMlSZu31Iw6d9wQfbh4LZSvA9HU9F6HXKcWtPy9IM0vV5dt+EqvyGgchLff9orrG7EYaqnOme53ooNsNpoOeafWfTabwaFSM9dt70abK5XjVedKxSHVR9vWMoJfLU4vX1kApAxoTVJ88j/1vf46SqmaaVldhRGOIRbcEkRcxHB4mpyE9vnReZ+faQdRM0RQvYXn5YCa+/ygj1i6AkkowOqBlJCXxr3lvrx9zYP/Z0Oa7H+ruqB8q4N582NvDXPKhysS3y/RWKcYF1UxAldpiN95URQhzVUR45TvqIdsIxk3kj0yNR+X/CqLuGdwH8lSulyCW3wC5/5S/0V68WKcsZRxe2iAlDUhGqD3hE/oMbKB+0UCMaAqRvRHSPs9dkId8Tk3QjZrdRbWPmCmaYsUsrhzK5Hce5OLXfwsV1RCNg5naJgSjpZ/y8I63MWbe3yCVgIhTR3RHdG/C5S73OxK54PxqXCWob247mKAq2ToR+KPP+YC6YP9D612V4nIYot349XGNRpLVdfkK5/voeaQmNkgTPRODzn8rVTDoIOCRAI7r9oGjCqYeAfzd21Q6MQ4N90wM/ajLeXgRgAYQMdm6voz22mJL+IHINNt3rBSCbvwCncZGzBQtsWK+6DecybPu52cz7oLKIZAoFeG3bZ4d0FHF1mQJGJ4Fn41uc8d3POz7Ivwnik7A2Un+FWlNS5X+dByS2uAnqrgz6vww+1x9gphR+XyUEaR43m/XbLcJ5x/gnOoSxX2poB/mKL4/Gb0SRyfG4z6T4SPF92cjCd9+fYFX6AyKoH8Tfh9J5gyQbCH4FRIkihJEICJipmiOFfNl31ruePs+Lp35G9H8soVfBq1mHJ/+7EORp48OXnLWLsNbCV0mqps7c0mEuai1Ca9t9W1Ui+YsIV1d0466Ueol+DtHe+O+VluVWPx9nEvlguYjnCOqA+m8gJAXdBtNZDIdZ/9kOf4rVPZDMzcxglzsumuQFuAJlk8IOvoElYjPr5ivqmqZPOsBfj7zbigbCEXleYVfQDymOW45+iVzmUTx15T0r6iFQ7ZAu0cx/hCkbZUXbkat/WXfaDp1x9NRp4LkohRZstMtK4AXFWMexn3qk83RwM8cXpfQ2eRLIZ1knLgd78saTCK9+JAbtqJOdr4Kb4tHgbgYntUdHEEy3p/QHL8//rpA5CFbCC60/u1NE8z0+d32riX8ygdDURmScV0w7kM/Cvmsj+PsjRT8u/Un/RZ1K7OFdO2I/ZDGvm9B0+zIYJL1cqKZrgJwBuryu1FIlUK1i/nUAP/C+2p7Ks1lINKctcrlficgAv1eh9d1dPV/P6DYr2HNx622/DPc10pncr/GmDfRr8Kx6YsodNpC3a6pvNPFQa5AXUzvgUwhuAC5D0txKwTF51fE5/2GcdPsR7hk+l1i9haVFVrzm4K7Hn86F4ETRyGR0ZM0xu6DmNuXa4zNdWE3oedTuxvxE++iGLcroi3p3ETXkjtnTaeH5b7IE1Xn73IBUtXiRauxmYXarbEn8nfT6ViSQLQ0HQXlbLreKAsQAedEDfK7z9M4Ri2iVd6rMdaJmeitk/0K8vDTeYidgZzX/dxMxE6cnI/4DPbV3O4mxPF9Be5TORywhWAx6cDIzjhEhzvRyec36wEu0fD5BUANssiR7uI0ICZAEAuBD0cEzlzkYvkYSV9JITlQuwFHol+r+SX5zab/Rlp9qYrsT7JezyCa5FeIz6cMEXxHot9T8n3yLyD1V8RUUqUGVSKa+ZXIOZqDpH6ZyA29N9J4UyW0dZmAOlVnEOIqmYi0/Z+LpBttRS7+WsTaOgm99XFfI7/Zfi7qcsUyZGmHK6z5zLHm045oqzsjTTFOwJtbIRdnobecxiVI+7OXkI5Ui5CqoQRybsYijW9Vtdg5ycwc/0/UEZpMzkIunMlIC6hc7d09YJJua2aXGe6yToRgB/mEYMTy+S2qrGmZ/M6DXDLjbii3fX4FMXuHI6kbk3C/3q/fKG42Y/G/OheoBdN4xHepcxOcjLuHQjbNwL8pxpyKfkrQLgQn5JxYj2h3Ol1+RuNP47Rx0iYXIKb59Rr72Y3gF0/Kp7V8jDzcVL0mQczCU6xXoGQKwDnA33DX738g0mr9DuRp/xbiDJ6JXo7bceTMSLeFoIFogh0Hwi5/l2LddiP7nIrmV2QuqqxJ3Tz74dpLZtz1Q/H5OQo/E4km6i7VORrJnRqOaDGH4q2j4O9IJ/W6wU6eLBQXop5XHfK0fbOA87A5GLV1sQgRsoVeptMtjyMWkmq1tiA4FnVy8S+RzAQvK7Dp0EH+skEn7eNSxD2j25M0cLInfR7y1HVbJhNHtAPb1DoftQMWRHPMU/qS6RP8ogXa+6SzcNqxhWDa5zeCW995kMunT3mS8sETNQMeO6C/hsAZeI902qwCfuFxWxN50JyNuqOGW36Nfkfnt5Bk1ZkURiA3In3tdHxEIMGkcwg+Q+EzxKen2+E7m1uQAKObdVvccjr6K/Udi/gDdVYHdMMUJP8xn59OpWAcgQQudBcC0+Ut5H5zVOiyL+Bm5AnvF92OHAqz2USCIGVbRE59glhfCcDc5vP7ou9wJs96gF/MuAvKB7W5CHi4SbYMonvGET62jSJrVYwLaC42l+I+qPUGUu73oWqgS15HfIxuXDEgFQ2noL8ei4o1yA3pV7Ocgsxrs+8ZdWYp8pBw0/Y/hVw7QVRZ2JyIXDtOUfMtin0kEW3fby5pJvOR86NKBs/5BP8X+uuI5qNr2Da3J0DDOWcC0RSUGmkhGCdixmiOF7GwqpZb332Qy2beBWUDoLjC1BR+bh2DfjOzT0DPX+W07uo4pM3W3qjX0VAxBzE98gUZVHyOOOpvQd+NkI9NSLT3KFyu6pXBM4jw9Nvp+DVrPw04lwvGHb7Lntdo9NcwVvFHxE/nxQ1hIn7TK/H3sNiM1Oc/j6xz4mQJKHvyWfM6C3HD+K2pfhIxq02cg7pxyD/xvxHYAkgmJBNEygwiiZTHJjx2t+YyYBmGOZ/WaB8WVQ7nxvce4bLpd0LZICiqgFRB8/y8cjrq6gUbJwFoP0aWIdrkhbivC56P5HHtSzBdgSchXZrvxn0gbDGSCrMjwZiKy5DI6bHom4Y2XyCBwGNJ5xg6pR24ycFch7gu9kRMdbca4UbEpTQaKYX023nmbiSy+zvc9d9LIZrarqRXJXTy39WhJwBt7rPmdQPuGzDPQ4TxD9Gz7IrBud/Zw4j6+jSea8NMMEsxjK/Z+kEbqT1iREpTJJsi0gfQNRGgjGRkORtKBnDj7Fe4YsaU7kpy9kIrEuj5p4ttTif/GgvZjQDus17HWK9DkNSAvojJnERunmWIxjgdb/XHKtYiWsX1iOlxGBIkGoak40SRi3IDouG9Zc2nUMGU16zXzkjA6mjEgTyQdA1xPeIjegdJsciVRnKf9Z1pvSLIPWPgbYGj+YhicTlyfg5BzL8apKY2hvzNNiPBxHeRc/UmwZn3NusQf/RE5PwciQT5hiIxAAO5fjcgkeRXkHORHdw80uEYi3Cv8jQhPulfIw/5wxEhOwI5R3Frn1uQdKY3rbnlsoiuQ5L/7b9f1HoZWJqmquHjM4iv5z5cl6aYkCwnGt/CwKHvsfkfRZipamrOlQeONyEo12BTvIqaxvlcMedhSFR2R5KzF15FNDS3TzIvLeanWy+bUuRmTRFsh2QVbaSFT/Zckvg3ld2y0HrZAbki0ik8TahvzjW402B0qUdyQTNLwuwi+O7+mzUhpqy9tottaoFEG7c6bDsW53ZYfh+2/6Sz8pDZKEDV7xDk3nO8/3Q63i5AnujXIU95jWZ5JiTLiMa+ZlDFe8SjrbT2L2PDtGKMSIqhZ0t2Q6op4iGOaGISIZ4y2JIooyqW6m3CbzWSG+k3W94P3XkDqehNc2m1Xr2RoB8O5UhVhFPArJGuVoWJvrapaoPmZ23mXAT+AHXT8nsyEoX8L8SfkafezoRk2dZotJ5BFbOJG620dZQSSaQoqjZZ/6xk2Aw5axPJqJlKNkR1DGyj839MUkaEZCRnmZyuuR50C/MliNvgTpyfmiEh3UEEsUJUwZofIT5/t1yOc9ej9UjlRq/Grf61BXF674BUDTxEpz5wJqRKiEbr+w+qnE3MaKUtVYqBCSYYcZOiIR2sf7aSNX/uRyRhxqMVSR0vgZtu1LpjI+hH8iB3y/aFyEPB7on3a0LhF9I7+Bq9+u0ngF+53PeViG/NCVUnml6B10V2OpCWTHZbpp3A3JFU0RDMaHm/snmnJyLNV7cmKwwjU0PLEIKbXi2n6dPi/jUXbLy6ZMfWttbVCcOI5Mw0MRBVXTcNZYo1L6fx1lLpygz6TJ5GnOZbrHelfyEkpIf5I1LfqyoBvBGpqLkf8SXnqggaigQkfopz4APk3vLb069bCGiVMXMRqeJFmBH6ln9EcWzz0W3J8l2MXDLIEoLxfklaFhdtXPH7AXeOvGYdRdXttK6NeYwOd+Jl6xU0H6BeSzckpLfxA/RKL/ci7bdehFh29aSbDuyFvry4AXW7sl5BAKVMYvaCQb+Kf1FRtIyOVIlzPoqV1lc8rN1sq4sXL7ltMG3rYhQNacdM9obVBUNCvjF8ibv6fpC8zvFI0vQJSM6orvCbA9zq8ng9hn8BmCzHMNoYWPEuZYk1tCUr0I0vmEkoqu6gfUOMJbcNpnVtnKKatlAIhoQEy/8h9dKFZguFa7hQEDwKQBPMKCTLScTXMbjyHUrim2hP5svfddhTCoqGdNC+LsayOwbTuiZO0dB2zFQoBENCAuQRJFjnpvLDDV8geYFB1z0XFG8CMNUHzARlJV9Inl+khTYPws/GTELR0A7a1sZYdvtg2upiFFW398LCjpCQ7ZpXkKU+ddet0eXPiI9wWcD7LTjuBGAqAckyYtF6BpS/R7/STzHNOO2pPuQMeLhgmxBcJ+Zw27qYaIKhORwSEiQbgDORRhZP4C+5+EWkSOJspApouyOW319nCTQzJoKPCJFoA+VFX1FWvIyI0UF7shwwfAu/bUe0fIKta2MsvWMwI6+to2hoO62r4xjRYI4REhICSCuzHyP10UciteTjkIa/VTnGNyHpXx8jCdYz8bcWdK8gRsqp+QgYkRYSiU0UxzfSJ1FHPNpIMlVMR6qUdI1xF/pqHn8AWRLY9gm2ro6xdPJgRlxTR2JQO23rQiEYElIA1iMtpJ60/l+OCMVy0hZiA5LWsl3593SIVZV+kuerCBGSxGMNxKMNRIwkyVTC0vryCj6bRUgTBScvnoH0getSB2Kbw62rYiy/cxDDfrGeWGWSVHMhO8KHhIQgwi7ozjO9FsM0Q60qJCTk20moUoWEhHxrCQVgSEjIt5b/D/JwH6M5Eni5AAAAAElFTkSuQmCC",
//                   width: 150
//               } );
//             }          
//           }
//       ]
//     }
//   });
