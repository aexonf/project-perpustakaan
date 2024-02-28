import React from "react";
import { Head, Link } from "@inertiajs/react";
import { Badge } from "@/components/ui/badge";
import Navbar from "@/components/Navbar";
import { Button } from "@/components/ui/button";
import SearchBar from "@/components/SearchBar";
import { ChevronLeft, ChevronRight } from "lucide-react";

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
                                    <Link
                                        preserveScroll
                                        preserveState
                                        href={`/?category=${item}`}
                                        key={index}
                                    >
                                        <Badge
                                            className="cursor-pointer"
                                            variant={"outline"}
                                        >
                                            {item}
                                        </Badge>
                                    </Link>
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
                                <Link
                                    preserveScroll
                                    preserveState
                                    href={`/?category=${item}`}
                                    key={index + 1}
                                >
                                    <Badge
                                        className="truncate cursor-pointer"
                                        variant={"outline"}
                                    >
                                        {item}
                                    </Badge>
                                </Link>
                            ))}
                        </div>
                        <div className="gap-5 flex flex-wrap">
                            {data.data.length == 0 ? (
                                <h2 className="text-center font-semibold text-2xl font-jakarta">
                                    Belum ada koleksi yang dibuat.
                                </h2>
                            ) : (
                                data.data.map((item, index) => (
                                    <Link
                                        preserveScroll
                                        preserveState
                                        href={`/detail/${item.id}`}
                                        className="p-3 bg-[#f1f1f1] w-40 flex items-center flex-col hover:shadow-lg duration-300 rounded-lg cursor-pointer"
                                        key={index + 1}
                                    >
                                        <img
                                            src={
                                                item.image
                                                    ? `/storage/upload/book/${item.image}`
                                                    : "/image/notfound.jpg"
                                            }
                                            alt={item.series_title}
                                            className="h-40 mb-3 object-cover"
                                        />
                                        <p className="break-words text-lg">
                                            {item.series_title}
                                        </p>
                                    </Link>
                                ))
                            )}
                        </div>
                        {console.log(data)}
                        {data.last_page > 1 && (
                            <div className="flex justify-center items-center w-full my-5">
                                {data.data.length > 0 && (
                                    <>
                                        {!(data.current_page == 1) && (
                                            <Link
                                                preserveScroll
                                                preserveState
                                                href={data.prev_page_url}
                                                disabled={
                                                    data.current_page == 1
                                                }
                                            >
                                                <Button
                                                    disabled={
                                                        data.current_page == 1
                                                    }
                                                >
                                                    <ChevronLeft className="size-5" />
                                                </Button>
                                            </Link>
                                        )}
                                        <p className="mx-4 text-lg">
                                            {data.current_page} /{" "}
                                            {data.last_page}
                                        </p>
                                        {!(
                                            data.current_page == data.last_page
                                        ) && (
                                            <Link
                                                preserveScroll
                                                preserveState
                                                href={data.next_page_url}
                                                disabled={
                                                    data.current_page ==
                                                    data.last_page
                                                }
                                            >
                                                <Button
                                                    disabled={
                                                        data.current_page ==
                                                        data.last_page
                                                    }
                                                >
                                                    <ChevronRight className="size-5" />
                                                </Button>
                                            </Link>
                                        )}
                                    </>
                                )}
                            </div>
                        )}
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
                                <Link
                                    preserveScroll
                                    preserveState
                                    href={`/?category=${item}`}
                                    key={index + 1}
                                >
                                    <Badge
                                        className="truncate cursor-pointer"
                                        variant={"outline"}
                                    >
                                        {item}
                                    </Badge>
                                </Link>
                            ))}
                        </div>
                        <div className="gap-5 flex flex-wrap">
                            {bookLatest.data.length == 0 ? (
                                <h2 className="text-center font-semibold text-2xl font-jakarta">
                                    Belum ada koleksi Baru yang dibuat.
                                </h2>
                            ) : (
                                bookLatest.data.map((item, index) => (
                                    <Link
                                        preserveScroll
                                        preserveState
                                        href={`/detail/${item.id}`}
                                        className="p-3 bg-[#f1f1f1] w-40 flex items-center flex-col hover:shadow-lg duration-300 rounded-lg"
                                        key={index + 1}
                                    >
                                        <img
                                            src={
                                                item.image
                                                    ? `/storage/upload/book/${item.image}`
                                                    : "/image/notfound.jpg"
                                            }
                                            alt={item.series_title}
                                            className="h-40 mb-3 object-cover"
                                        />
                                        <p className="break-words text-lg">
                                            {item.series_title}
                                        </p>
                                    </Link>
                                ))
                            )}
                        </div>
                        {bookLatest.last_page > 1 && (
                            <div className="flex justify-center items-center w-full my-5">
                                {bookLatest.data.length > 0 && (
                                    <>
                                        {!(bookLatest.current_page == 1) && (
                                            <Link
                                                preserveScroll
                                                preserveState
                                                href={data.prev_page_url}
                                                disabled={
                                                    data.current_page == 1
                                                }
                                            >
                                                <Button
                                                    disabled={
                                                        data.current_page == 1
                                                    }
                                                >
                                                    <ChevronLeft className="size-5" />
                                                </Button>
                                            </Link>
                                        )}
                                        <p className="mx-4 text-lg">
                                            {bookLatest.current_page} /{" "}
                                            {bookLatest.last_page}
                                        </p>
                                        {!(
                                            bookLatest.current_page ==
                                            bookLatest.last_page
                                        ) && (
                                            <Link
                                                preserveScroll
                                                preserveState
                                                disabled={
                                                    bookLatest.current_page ==
                                                    bookLatest.last_page
                                                }
                                                href={bookLatest.next_page_url}
                                            >
                                                <Button
                                                    disabled={
                                                        bookLatest.current_page ==
                                                        bookLatest.last_page
                                                    }
                                                >
                                                    <ChevronRight className="size-5" />
                                                </Button>
                                            </Link>
                                        )}
                                    </>
                                )}
                            </div>
                        )}
                    </div>
                </section>
            </main>
        </>
    );
}
