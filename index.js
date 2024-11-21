console.log('Hello World!');
function updateAmountText(currentInput) {
  //  Loại bỏ dấu cham '.' trong số
  let advanceAmount = currentInput.value.replace(/\./g, '');
  // check if not a number
  if (isNaN(advanceAmount)) {
    alert('Vui lòng nhập số');
    currentInput.value = '';
    return;
  }
  currentInput.value = formatNumber(advanceAmount); // Chèn dấu phẩy vào số
}

function formatNumber(num) {
  return num.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function convertNumberToTextVND(total) {
  try {
    let rs = "";
    let ch = ["không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín"];
    let rch = ["lẻ", "mốt", "", "", "", "lăm"];
    let u = ["", "mươi", "trăm", "ngàn", "", "", "triệu", "", "", "tỷ", "", "", "ngàn", "", "", "triệu"];
    let nstr = total.toString();
    let n = Array.from(nstr).reverse().map(Number);
    let len = n.length;

    for (let i = len - 1; i >= 0; i--) {
      if (i % 3 === 2) {
        if (n[i] === 0 && n[i - 1] === 0 && n[i - 2] === 0) continue;
      } else if (i % 3 === 1) {
        if (n[i] === 0) {
          if (n[i - 1] === 0) continue;
          else {
            rs += " " + rch[n[i]];
            continue;
          }
        }
        if (n[i] === 1) {
          rs += " mười";
          continue;
        }
      } else if (i !== len - 1) {
        if (n[i] === 0) {
          if (i + 2 <= len - 1 && n[i + 2] === 0 && n[i + 1] === 0) continue;
          rs += " " + (i % 3 === 0 ? u[i] : u[i % 3]);
          continue;
        }
        if (n[i] === 1) {
          rs += " " + ((n[i + 1] === 1 || n[i + 1] === 0) ? ch[n[i]] : rch[n[i]]);
          rs += " " + (i % 3 === 0 ? u[i] : u[i % 3]);
          continue;
        }
        if (n[i] === 5) {
          if (n[i + 1] !== 0) {
            rs += " " + rch[n[i]];
            rs += " " + (i % 3 === 0 ? u[i] : u[i % 3]);
            continue;
          }
        }
      }
      rs += (rs === "" ? " " : ", ") + ch[n[i]];
      rs += " " + (i % 3 === 0 ? u[i] : u[i % 3]);
    }

    rs = rs.trim().replace(/lẻ,|mươi,|trăm,|mười,/g, match => match.slice(0, -1));

    if (rs.slice(-1) !== " ") {
      rs += " đồng";
    } else {
      rs += "đồng";
    }

    return rs.charAt(0).toUpperCase() + rs.slice(1);
  } catch (ex) {
    console.error(ex);
    return "";
  }
}