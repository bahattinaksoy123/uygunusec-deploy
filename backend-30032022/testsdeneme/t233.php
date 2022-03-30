<div class="output"></div>
<script>
const your_Array = [
  "Test 1 ",
  "Test 2",
  "Test 3",
  "Test 4",
  "Test 5", 
];
const INTERVAL = 1000;  // in milliseconds
your_Array.forEach((item, index) => {
    setTimeout(() => {
        document.getElementsByClassName("output")[0].innerText = item;
    }, INTERVAL * index);
});
</script>