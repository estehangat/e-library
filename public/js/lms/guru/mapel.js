const tambahButton = document.getElementById("tambah-attachment");
const tutupButton = document.getElementById("close-attachment");
const attachmentContainer = document.getElementById("attachment-container");
const tipeOption = document.getElementById("attachment-type");
const attachmentInputContainer = document.getElementById("attachment-input");
const attachmentResource = document.getElementById("attachment-resource");
const includeAttachment = document.getElementById("include-attachment");

tambahButton.addEventListener("click", function(event){
    event.preventDefault();
    attachmentContainer.classList.remove("d-none");
    attachmentContainer.classList.add("d-block");
    includeAttachment.value = "1";
});

tutupButton.addEventListener("click", function(event){
    event.preventDefault();
    attachmentContainer.classList.remove("d-block");
    attachmentContainer.classList.add("d-none");
    includeAttachment.value = "0";
});

tipeOption.addEventListener('change', function(){
    const selectedValue = this.value;

    if (selectedValue === "material"){
        attachmentResource.innerHTML = `
            <label for="attachment-material">File Materi</label><br>
            <input type="file" name="attachment-material" id="attachment-material"><br>
        `;
    } else if (selectedValue === "discussion"){
        attachmentResource.innerHTML = `
            <label for="attachment-discussion-open">Watktu buka diskusi</label><br>
            <input type="datetime-local" name="attachment-discussion-open" id="attachment-discussion-open"><br>

            <label for="attachment-discussion-close">Watktu tutup diskusi</label><br>
            <input type="datetime-local" name="attachment-discussion-close" id="attachment-discussion-close"><br>

            <label for="restrict">Kunci akses siswa?</label>
            <select name="restrict" id="restrict">
                <option value="0" selected>Tidak</option>
                <option value="1">Ya</option>
            </select>
        `;
    } else if (selectedValue === "attendance") {
        attachmentResource.innerHTML = `
            <label for="attachment-attendance-open">Watktu buka absensi</label><br>
            <input type="datetime-local" name="attachment-attendance-open" id="attachment-attendance-open"><br>

            <label for="attachment-attendance-close">Watktu tutup absensi</label><br>
            <input type="datetime-local" name="attachment-attendance-close" id="attachment-attendance-close"><br>
        `;
    } else if (selectedValue === "assignment") {
        attachmentResource.innerHTML = `
            <label for="attachment-assignment-open">Watktu buka tugas</label><br>
            <input type="datetime-local" name="attachment-assignment-open" id="attachment-assignment-open"><br>

            <label for="attachment-assignment-close">Watktu tutup tugas</label><br>
            <input type="datetime-local" name="attachment-assignment-close" id="attachment-assignment-close"><br>

            <label for="restrict">Kunci akses siswa?</label>
            <select name="restrict" id="restrict">
                <option value="0" selected>Tidak</option>
                <option value="1">Ya</option>
            </select>
        `;
    } else if (selectedValue === "quiz") {
        attachmentResource.innerHTML = `
            <label for="attachment-quiz-limit">Batas waktu</label><br>
            <input type="time" name="attachment-quiz-limit" id="attachment-quiz-limit"><br>

            <label for="attachment-total-questions">Jumlah pertanyaan</label><br>
            <input type="number" name="attachment-total-questions" id="attachment-total-questions"><br>

            <label for="attachment-quiz-open">Watktu buka kuis</label><br>
            <input type="datetime-local" name="attachment-quiz-open" id="attachment-quiz-open"><br>

            <label for="attachment-quiz-close">Watktu tutup kuis</label><br>
            <input type="datetime-local" name="attachment-quiz-close" id="attachment-quiz-close"><br>

            <label for="restrict">Kunci akses siswa?</label>
            <select name="restrict" id="restrict">
                <option value="0" selected>Tidak</option>
                <option value="1">Ya</option>
            </select>

            <p>Anda perlu membuat soal kuis setelah melampirkan data ini!</p>
        `;
    }
});

