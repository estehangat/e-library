let attachmentIndex = 0;

const tambahButton = document.getElementById("tambah-attachment");
const newAttachmentWrapper = document.getElementById("new-attachment-wrapper");

tambahButton.addEventListener("click", function (event) {
    event.preventDefault();

    const attachmentContainer = document.createElement("div");
    attachmentContainer.classList.add("new-attachment-container", "mb-4");

    attachmentContainer.innerHTML = `
        <div class="mb-2">
            <label>Tipe attachment:</label>
            <select name="new_attachments[${attachmentIndex}][type]" class="form-control attachment-type">
                <option value="material" selected>Material</option>
                <option value="discussion">Discussion</option>
                <option value="attendance">Attendance</option>
                <option value="assignment">Assignment</option>
                <option value="quiz">Quiz</option>
            </select>
        </div>

        <div class="mb-2">
            <label>Judul</label>
            <input type="text" name="new_attachments[${attachmentIndex}][title]" class="form-control">
        </div>

        <div class="mb-2">
            <label>Deskripsi</label>
            <input type="text" name="new_attachments[${attachmentIndex}][description]" class="form-control">
        </div>

        <div class="attachment-resource mt-3">
        
        </div>

        <button type="button" class="btn btn-danger mt-3 remove-attachment">Hapus Attachment</button>
    `;

    newAttachmentWrapper.appendChild(attachmentContainer);

    const typeSelect = attachmentContainer.querySelector(".attachment-type");
    const resourceContainer = attachmentContainer.querySelector(".attachment-resource");
    const currentIndex = attachmentIndex;

    typeSelect.addEventListener("change", function () {
        const selectedValue = this.value;
        let innerHTML = "";

        if (selectedValue === "material") {
            innerHTML = `
                <label>File Materi</label>
                <input type="file" name="new_attachments[${currentIndex}][file]" class="form-control">
            `;
        } else if (selectedValue === "discussion") {
            innerHTML = `
                <label>Waktu buka diskusi</label>
                <input type="datetime-local" name="new_attachments[${currentIndex}][open]" class="form-control">

                <label>Waktu tutup diskusi</label>
                <input type="datetime-local" name="new_attachments[${currentIndex}][close]" class="form-control">

                <label>Kunci akses siswa?</label>
                <select name="new_attachments[${currentIndex}][restrict]" class="form-control">
                    <option value="0" selected>Tidak</option>
                    <option value="1">Ya</option>
                </select>
            `;
        } else if (selectedValue === "attendance") {
            innerHTML = `
                <label>Waktu buka absensi</label>
                <input type="datetime-local" name="new_attachments[${currentIndex}][attendance_open]" class="form-control">

                <label>Waktu tutup absensi</label>
                <input type="datetime-local" name="new_attachments[${currentIndex}][attendance_close]" class="form-control">
            `;
        } else if (selectedValue === "assignment") {
            innerHTML = `
                <label>Waktu buka tugas</label>
                <input type="datetime-local" name="new_attachments[${currentIndex}][open]" class="form-control">

                <label>Waktu tutup tugas</label>
                <input type="datetime-local" name="new_attachments[${currentIndex}][close]" class="form-control">

                <label>Kunci akses siswa?</label>
                <select name="new_attachments[${currentIndex}][restrict]" class="form-control">
                    <option value="0" selected>Tidak</option>
                    <option value="1">Ya</option>
                </select>
            `;
        } else if (selectedValue === "quiz") {
            innerHTML = `
                <label>Batas waktu</label>
                <input type="time" name="new_attachments[${currentIndex}][quiz_limit]" class="form-control">

                <label>Jumlah pertanyaan</label>
                <input type="number" name="new_attachments[${currentIndex}][total_questions]" class="form-control">

                <label>Waktu buka kuis</label>
                <input type="datetime-local" name="new_attachments[${currentIndex}][quiz_open]" class="form-control">

                <label>Waktu tutup kuis</label>
                <input type="datetime-local" name="new_attachments[${currentIndex}][quiz_close]" class="form-control">

                <label>Kunci akses siswa?</label>
                <select name="new_attachments[${currentIndex}][restrict]" class="form-control">
                    <option value="0" selected>Tidak</option>
                    <option value="1">Ya</option>
                </select>

                <p class="mt-2 text-danger">Anda perlu membuat soal kuis setelah melampirkan data ini!</p>
            `;
        }

        resourceContainer.innerHTML = innerHTML;
        console.log(typeSelect)
        console.log(resourceContainer)
    });

    const removeButton = attachmentContainer.querySelector(".remove-attachment");
    removeButton.addEventListener("click", function () {
        attachmentContainer.remove();
    });

    typeSelect.dispatchEvent(new Event('change'));

    attachmentIndex++;
});