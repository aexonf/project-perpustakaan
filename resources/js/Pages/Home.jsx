import React from "react";
import { Head, Link } from "@inertiajs/react";
import { Badge } from "@/components/ui/badge";
import Navbar from "@/components/Navbar";
import SearchBar from "@/components/SearchBar";

export default function Welcome({ data, bookLatest, category }) {
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
                            <div className="flex flex-wrap justify-center px-0 gap-5">
                                {category.map((item, index) => (
                                    <Badge
                                        className="cursor-pointer"
                                        variant={"outline"}
                                        key={index}
                                    >
                                        <Link href={`/?category=${item}`}>
                                            {item}
                                        </Link>
                                    </Badge>
                                ))}
                            </div>
                        </div>
                    </div>
                    <div className="w-full h-full">
                        <h2 className="font-bold text-2xl">Koleksi Kami</h2>
                        <p className="font-normal text-xl">
                            Koleksi-koleksi kami yang dibaca oleh banyak
                            pengunjung perpustakaan. Cari. Pinjam. Kami harap
                            Anda menyukainya
                        </p>
                        <div className="flex gap-5 my-4 flex-wrap">
                            {category.map((item, index) => (
                                <Badge
                                    className="truncate cursor-pointer"
                                    variant={"outline"}
                                    key={index + 1}
                                >
                                    <Link href={`/?category=${item}`}>
                                        {item}
                                    </Link>
                                </Badge>
                            ))}
                        </div>
                        <div className="gap-5 flex flex-wrap">
                            {data.map((item, index) => (
                                <Link
                                    href={`/detail/${item.id}`}
                                    className="p-3 bg-[#f1f1f1] w-40 flex items-center flex-col hover:shadow-lg duration-300 rounded-lg cursor-pointer"
                                    key={index + 1}
                                >
                                    <img
                                        src={
                                            item.image
                                                ? item.image
                                                : "/image/notfound.jpg"
                                        }
                                        alt=""
                                        className="h-40 mb-3"
                                    />
                                    <p className="break-words text-lg">
                                        {item.series_title}
                                    </p>
                                </Link>
                            ))}
                        </div>
                    </div>
                    <div className="w-full h-full mt-20">
                        <h2 className="font-bold text-2xl">
                            Koleksi baru dan diperbarui
                        </h2>
                        <p className="font-normal text-xl">
                            Merupakan daftar koleksi-koleksi terbaru kami. Tidak
                            semuanya baru, adapula koleksi yang data-datanya
                            sudah diperbaiki. Selamat menikmati
                        </p>
                        <div className="flex gap-5 my-4 flex-wrap">
                            {category.map((item, index) => (
                                <Badge
                                    className="truncate cursor-pointer"
                                    variant={"outline"}
                                    key={index + 1}
                                >
                                    <Link href={`/?category=${item}`}>
                                        {item}
                                    </Link>
                                </Badge>
                            ))}
                        </div>
                        <div className="gap-5 flex flex-wrap">
                            {bookLatest.map((item, index) => (
                                <Link
                                    href={`/detail/${item.id}`}
                                    className="p-3 bg-[#f1f1f1] w-40 flex items-center flex-col hover:shadow-lg duration-300 rounded-lg"
                                    key={index + 1}
                                >
                                    <img
                                        src={
                                            item.image
                                                ? item.image
                                                : "/image/notfound.jpg"
                                        }
                                        alt=""
                                        className="h-40 mb-3"
                                    />
                                    <p className="break-words text-lg">
                                        {item.series_title}
                                    </p>
                                </Link>
                            ))}
                        </div>
                    </div>
                </section>
            </main>
        </>
    );
}
