<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Work+Sans%3Awght%40400%3B500%3B700%3B900"
    />

    <title>Stitch Design</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  </head>
  <body>
    <div class="relative flex h-auto min-h-screen w-full flex-col bg-white group/design-root overflow-x-hidden" style='font-family: "Work Sans", "Noto Sans", sans-serif;'>
      <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f0f1f4] px-10 py-3">
          <div class="flex items-center gap-4 text-[#111318]">
            <div class="size-4">
              <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 4H42V17.3333V30.6667H24V44H6V30.6667V17.3333H24V4Z" fill="currentColor"></path>
              </svg>
            </div>
            <h2 class="text-[#111318] text-lg font-bold leading-tight tracking-[-0.015em]">DipaTalent</h2>
          </div>
          <div class="flex flex-1 justify-end gap-8">
            <div class="flex items-center gap-9">
              <a class="text-[#111318] text-sm font-medium leading-normal" href="#">Beranda</a>
              <a class="text-[#111318] text-sm font-medium leading-normal" href="#">Beasiswa</a>
              <a class="text-[#111318] text-sm font-medium leading-normal" href="#">Prestasi</a>
              <a class="text-[#111318] text-sm font-medium leading-normal" href="#">Profil</a>
            </div>
            <div
              class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
              style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCJD7ix7-mf6nT0wZLLjR-ztTIx2iiquclXJYgOYajCVcJOGwovp3XpcXu1KDoYNxElR1JlT9DD9jh-yamQEgLLigsKC7G-2bVvk9QPSIxAX7HacdvbWOP_DLZdK4CYugECcNjfIrMVlETrVyE0Cy3NZ79bwCOQE5CBa3qh_MdG2UdG0_i7hjtG3mjYcleqpknz4U_FZhmac-Brfn27FK1QmYs3jxsgeBoU5rAML-PDm4qunOxdqV_HjSmnvag3AWv2D9d_fZFMhA");'
            ></div>
          </div>
        </header>
        <div class="px-40 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col w-[512px] max-w-[512px] py-5 max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4">
              <p class="text-[#111318] tracking-light text-[32px] font-bold leading-tight min-w-72">Form Pengajuan Beasiswa</p>
            </div>
            <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
              <label class="flex flex-col min-w-40 flex-1">
                <p class="text-[#111318] text-base font-medium leading-normal pb-2">Nama Beasiswa</p>
                <input
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111318] focus:outline-0 focus:ring-0 border border-[#dcdee5] bg-white focus:border-[#dcdee5] h-14 placeholder:text-[#636d88] p-[15px] text-base font-normal leading-normal"
                  value=""
                />
              </label>
            </div>
            <div class="flex flex-col p-4">
              <div class="flex flex-col items-center gap-6 rounded-lg border-2 border-dashed border-[#dcdee5] px-6 py-14">
                <div class="flex max-w-[480px] flex-col items-center gap-2">
                  <p class="text-[#111318] text-lg font-bold leading-tight tracking-[-0.015em] max-w-[480px] text-center">Unggah Dokumen</p>
                  <p class="text-[#111318] text-sm font-normal leading-normal max-w-[480px] text-center">Seret &amp; lepas file di sini, atau klik untuk memilih file</p>
                </div>
                <button
                  class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#f0f1f4] text-[#111318] text-sm font-bold leading-normal tracking-[0.015em]"
                >
                  <span class="truncate">Pilih File</span>
                </button>
              </div>
            </div>
            <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
              <label class="flex flex-col min-w-40 flex-1">
                <p class="text-[#111318] text-base font-medium leading-normal pb-2">Catatan Tambahan</p>
                <textarea
                  placeholder="Tambahkan catatan tambahan"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111318] focus:outline-0 focus:ring-0 border border-[#dcdee5] bg-white focus:border-[#dcdee5] min-h-36 placeholder:text-[#636d88] p-[15px] text-base font-normal leading-normal"
                ></textarea>
              </label>
            </div>
            <div class="flex px-4 py-3 justify-end">
              <button
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#153fb2] text-white text-sm font-bold leading-normal tracking-[0.015em]"
              >
                <span class="truncate">Kirim Pengajuan</span>
              </button>
            </div>
            <p class="text-[#636d88] text-sm font-normal leading-normal pb-3 pt-1 px-4">Status: Menunggu verifikasi admin</p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
