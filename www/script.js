// Только alert перед отправкой: preventDefault не вызываем,
// форма уходит на process.php методом POST.
document.getElementById("demoForm").addEventListener("submit", function () {
  const username = document.querySelector("[name='username']").value;
  alert("Вы ввели имя: " + username);
});
