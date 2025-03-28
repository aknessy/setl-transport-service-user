function numberFormat(number, decimals = 0, decPoint = '.', thousandsSep = ',') {
    const fixed = number.toFixed(decimals);
    const parts = fixed.split('.');
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSep);
    return parts.join(decPoint);
  }
  
//   const formatted = numberFormat(1234567.89, 2, '.', ',');
//   console.log(formatted); // Output: "1,234,567.89"