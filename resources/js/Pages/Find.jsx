import { Head, Link } from "@inertiajs/react";
import React from "react";
import Navbar from "@/components/Navbar";
import SearchBar from "@/components/SearchBar";
import { Button } from "@/components/ui/button";
import { cn } from "@/lib/utils";

import { ChevronLeft, ChevronRight } from "lucide-react";
import NotFound from "../assets/not-found";

export default function DetailBookPage({ data, category }) {
    const url = new URL(window.location.href);
    const paramTitle = url.searchParams.get("title");
    const paramCategory = url.searchParams.get("category");
    return (
        <>
            <Head title="Pencarian Buku" />
            <Navbar className="h-[160px] max-h-[160px]" />
            <main className="w-full px-4 ">
                <SearchBar />
                <section
                    className="my-10 space-y-10 w-full container "
                    id="content"
                >
                    <div className="flex justify-start items-start w-full flex-col gap-10 ">
                        {data.data.length > 0 ? (
                            data.data.map((book) => (
                                <Link
                                    href={`/detail/${book.id}`}
                                    className="p-3 bg-[#f1f1f1] flex justify-between hover:shadow-lg duration-300 rounded-lg w-full"
                                    key={book.id}
                                >
                                    <img
                                        src={
                                            book.image
                                                ? `/storage/upload/book/${book.image}`
                                                : "/image/notfound.jpg"
                                        }
                                        alt=""
                                        className="h-44 w-36 mr-5"
                                    />
                                    <div className="grow ">
                                        <h2 className="break-words text-2xl font-semibold">
                                            {book.series_title}
                                        </h2>
                                        <table className="text-base font-jakarta">
                                            <tbody>
                                                <tr>
                                                    <td className="pr-20">
                                                        <strong>Edisi</strong>
                                                    </td>
                                                    <td>
                                                        {book.edition || "-"}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td className="pr-20">
                                                        <strong>
                                                            ISBN/ISSN
                                                        </strong>
                                                    </td>
                                                    <td>
                                                        {book.isbn_issn || "-"}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td className="pr-20">
                                                        <strong>
                                                            Deskripsi Fisik
                                                        </strong>
                                                    </td>
                                                    <td>
                                                        {book.physical_description ||
                                                            "-"}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td className="pr-20">
                                                        <strong>
                                                            No. Inventaris
                                                        </strong>
                                                    </td>
                                                    <td>
                                                        {book.call_no || "-"}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div
                                        className={cn(
                                            "flex flex-col items-center justify-between border w-40",
                                            book.stock <= 0 &&
                                                "cursor-not-allowed"
                                        )}
                                    >
                                        <p className="text-xl">Ketersediaan</p>
                                        <p
                                            className={cn(
                                                "text-5xl",
                                                book.stock <= 0 &&
                                                    "text-destructive "
                                            )}
                                        >
                                            {book.stock}
                                        </p>
                                        <p></p>
                                    </div>
                                </Link>
                            ))
                        ) : (
                            <div className="flex items-center justify-center w-full  flex-col">
                                <NotFound className="size-[400px]" />
                                <h3 className="text-destructive text-xl md:text-2xl">
                                    <strong>Buku Tidak ditemukan</strong>.
                                    Apakah kata kunci sudah benar?
                                </h3>
                            </div>
                        )}
                        {data.last_page > 1 && (
                            <div className="flex justify-center items-center w-full">
                                {data.data.length > 0 && (
                                    <>
                                        <Button
                                            asChild
                                            disabled={data.current_page === 1}
                                        >
                                            <Link
                                                href={`/${
                                                    paramTitle != null
                                                        ? `?title=${paramTitle}`
                                                        : ""
                                                }${
                                                    paramCategory != null
                                                        ? `?category=${paramCategory}`
                                                        : ""
                                                }&page=${
                                                    data.current_page - 1
                                                }`}
                                            >
                                                <ChevronLeft className="size-5" />
                                            </Link>
                                        </Button>
                                        <p className="mx-4 text-lg">
                                            {data.current_page} /{" "}
                                            {data.last_page}
                                        </p>
                                        <Button
                                            asChild
                                            disabled={
                                                data.current_page ===
                                                data.last_page
                                            }
                                        >
                                            <Link
                                                href={`/${
                                                    paramTitle != null
                                                        ? `?title=${paramTitle}`
                                                        : ""
                                                }${
                                                    paramCategory != null
                                                        ? `?category=${paramCategory}`
                                                        : ""
                                                }&page=${
                                                    data.current_page + 1
                                                }`}
                                            >
                                                <ChevronRight className="size-5" />
                                            </Link>
                                        </Button>
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
