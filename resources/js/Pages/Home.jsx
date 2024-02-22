import React from "react";
import { Head } from "@inertiajs/react";
import { Badge } from "@/components/ui/badge";
import Navbar from "@/components/Navbar";
import SearchBar from "@/components/SearchBar";

export default function Welcome() {
    return (
        <>
            <Head title="Online Public Access Catalog (OPAC) | PERPUSTAKAAN" />
            <Navbar />
            <main className="w-full px-4">
                <SearchBar />
                <section
                    className="my-10 space-y-10 w-full container"
                    id="content"
                >
                    <div className="flex justify-center items-center flex-col w-full">
                        <h1 className="text-2xl">
                            Pilih subjek yang menarik bagi Anda
                        </h1>
                        <div className="relative w-full h-full my-10">
                            <div className="flex flex-wrap justify-center px-0">
                                <div className="flex flex-col justify-center items-center m-2 border border-gray-300/80 w-[160px] h-[160px] rounded-md group">
                                    <img
                                        src="https://perpus.unpam.ac.id/template/default/assets/images/8-books.png"
                                        width={80}
                                        className="mb-3 mx-auto grayscale-[30%] group-hover:grayscale-0 transition-all duration-300"
                                        alt=""
                                    />
                                    <p>Kesastraan</p>
                                </div>

                                <div className="flex flex-col justify-center items-center m-2 border border-gray-300/80 w-[160px] h-[160px] rounded-md group">
                                    <img
                                        src="https://perpus.unpam.ac.id/template/default/assets/images/8-books.png"
                                        width={80}
                                        className="mb-3 mx-auto grayscale-[30%] group-hover:grayscale-0 transition-all duration-300"
                                        alt=""
                                    />
                                    <p>Kesastraan</p>
                                </div>

                                <div className="flex flex-col justify-center items-center m-2 border border-gray-300/80 w-[160px] h-[160px] rounded-md group">
                                    <img
                                        src="https://perpus.unpam.ac.id/template/default/assets/images/8-books.png"
                                        width={80}
                                        className="mb-3 mx-auto grayscale-[30%] group-hover:grayscale-0 transition-all duration-300"
                                        alt=""
                                    />
                                    <p>Kesastraan</p>
                                </div>

                                <div className="flex flex-col justify-center items-center m-2 border border-gray-300/80 w-[160px] h-[160px] rounded-md group">
                                    <img
                                        src="https://perpus.unpam.ac.id/template/default/assets/images/8-books.png"
                                        width={80}
                                        className="mb-3 mx-auto grayscale-[30%] group-hover:grayscale-0 transition-all duration-300"
                                        alt=""
                                    />
                                    <p>Kesastraan</p>
                                </div>

                                <div className="flex flex-col justify-center items-center m-2 border border-gray-300/80 w-[160px] h-[160px] rounded-md group">
                                    <img
                                        src="https://perpus.unpam.ac.id/template/default/assets/images/8-books.png"
                                        width={80}
                                        className="mb-3 mx-auto grayscale-[30%] group-hover:grayscale-0 transition-all duration-300"
                                        alt=""
                                    />
                                    <p>Kesastraan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="w-full h-full">
                        <h2 className="font-bold text-2xl">
                            Yang populer di antara koleksi kami
                        </h2>
                        <p className="font-normal text-xl">
                            Koleksi-koleksi kami yang dibaca oleh banyak
                            pengunjung perpustakaan. Cari. Pinjam. Kami harap
                            Anda menyukainya
                        </p>
                        <div className="flex gap-5 my-4">
                            <Badge className="px-10" variant={"outline"}>
                                Psikologi
                            </Badge>
                            <Badge className="px-10" variant={"outline"}>
                                Investasi
                            </Badge>
                            <Badge className="px-10" variant={"outline"}>
                                Metode Pertanian
                            </Badge>
                            <Badge className="px-10" variant={"outline"}>
                                Kuantitatif, Kualitatif Dan R&D
                            </Badge>
                            <Badge className="px-10" variant={"outline"}>
                                Manajemen Pemasaran
                            </Badge>
                        </div>
                        <div className="gap-5 flex flex-wrap">
                            <div className="p-3 bg-[#f1f1f1] w-40 flex items-center justify-center flex-col hover:shadow-lg duration-300 rounded-lg">
                                <img
                                    src="/image/logo.png"
                                    alt=""
                                    className="h-40"
                                />
                                <p className="break-words text-lg">
                                    Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit. Omnis, corrupti?
                                </p>
                            </div>
                        </div>
                    </div>
                    <div className="w-full h-full mt-20">
                        <h2 className="font-bold text-2xl">
                            Koleksi baru dan diperbarui
                        </h2>
                        <p className="font-normal text-xl">
                            Koleksi-koleksi kami yang dibaca oleh banyak
                            pengunjung perpustakaan. Cari. Pinjam. Kami harap
                            Anda menyukainya
                        </p>
                        <div className="flex gap-5 my-4">
                            <Badge className="px-10" variant={"outline"}>
                                Kepemimpinan
                            </Badge>
                            <Badge className="px-10" variant={"outline"}>
                                Mesin
                            </Badge>
                            <Badge className="px-10" variant={"outline"}>
                                Kalkulus
                            </Badge>
                            <Badge className="px-10" variant={"outline"}>
                                Hukum Agraria
                            </Badge>
                            <Badge className="px-10" variant={"outline"}>
                                Metodologi Penelitian
                            </Badge>
                        </div>
                        <div className="gap-5 flex flex-wrap">
                            <div className="p-3 bg-[#f1f1f1] w-40 flex items-center justify-center flex-col hover:shadow-lg duration-300 rounded-lg">
                                <img
                                    src="/image/logo.png"
                                    alt=""
                                    className="h-40"
                                />
                                <p className="break-words text-lg">
                                    Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit. Omnis, corrupti?
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </>
    );
}
