import { Head } from "@inertiajs/react";
import React from "react";
import Navbar from "@/components/Navbar";
import SearchBar from "@/components/SearchBar";
import { Separator } from "@/components/ui/separator";
import { Badge } from "@/components/ui/badge";

export default function DetailBookPage({ book }) {
    console.log(book);

    return (
        <>
            <Head title={book.series_title || "DETAIL BUKU"} />
            <Navbar className="h-[160px] max-h-[160px]" />
            <main className="w-full px-4">
                <SearchBar />
                <section
                    className="my-10 space-y-10 w-full container"
                    id="content"
                >
                    <div className="flex justify-start items-start w-full md:flex-row flex-col">
                        <div className="p-5 bg-[#d9e0e6] mr-10 rounded-lg">
                            <img
                                src={
                                    book.image !== null
                                        ? book.image
                                        : "/image/notfound.jpg"
                                }
                                className={"w-[150px] h-[250px] object-cover"}
                                alt=""
                            />
                        </div>
                        <div>
                            <div className="space-y-5 mb-4">
                                <h1 className="text-3xl font-semibold">
                                    {book.series_title}
                                </h1>
                                <Separator />
                                <p className="text-xl">
                                    {book.description ||
                                        "Deskripsi tidak tersedia."}
                                </p>
                                <Separator />
                                <h2 className="text-2xl font-semibold">
                                    Ketersediaan
                                </h2>
                                <Badge
                                    variant={
                                        book.status == "available"
                                            ? "default"
                                            : "destructive"
                                    }
                                    className="text-lg"
                                >
                                    {book.status === "available"
                                        ? "Tersedia"
                                        : "Tidak Tersedia"}
                                </Badge>
                                <Separator />
                            </div>
                            <table className="text-lg font-jakarta">
                                <tbody>
                                    <tr>
                                        <td className="pr-20">
                                            <strong>No. Panggil</strong>
                                        </td>
                                        <td>{book.call_no || "-"}</td>
                                    </tr>
                                    <tr>
                                        <td className="pr-20">
                                            <strong>Penerbit</strong>
                                        </td>
                                        <td>{book.publisher || "-"}</td>
                                    </tr>
                                    <tr>
                                        <td className="pr-20">
                                            <strong>Deskripsi Fisik</strong>
                                        </td>
                                        <td>{book.physical_description || "-"}</td>
                                    </tr>
                                    <tr>
                                        <td className="pr-20">
                                            <strong>Bahasa</strong>
                                        </td>
                                        <td>{book.language || "-"}</td>
                                    </tr>
                                    <tr>
                                        <td className="pr-20">
                                            <strong>ISBN/ISSN</strong>
                                        </td>
                                        <td>{book.isbn_issn || "-"}</td>
                                    </tr>
                                    <tr>
                                        <td className="pr-20">
                                            <strong>Klasifikasi</strong>
                                        </td>
                                        <td>{book.classification || "-"}</td>
                                    </tr>
                                    <tr>
                                        <td className="pr-20">
                                            <strong>Tipe Isi</strong>
                                        </td>
                                        <td>{book.content_type || "-"}</td>
                                    </tr>
                                    <tr>
                                        <td className="pr-20">
                                            <strong>Tipe Media</strong>
                                        </td>
                                        <td>{book.media_type || "-"}</td>
                                    </tr>
                                    <tr>
                                        <td className="pr-20">
                                            <strong>Tipe Pembawa</strong>
                                        </td>
                                        <td>{book.carrier_type || "-"}</td>
                                    </tr>
                                    <tr>
                                        <td className="pr-20">
                                            <strong>Edisi</strong>
                                        </td>
                                        <td>{book.edition || "-"}</td>
                                    </tr>
                                    <tr>
                                        <td className="pr-20">
                                            <strong>Subjek</strong>
                                        </td>
                                        <td>{book.subject || "-"}</td>
                                    </tr>
                                    <tr>
                                        <td className="pr-20">
                                            <strong>Info Detail Spesifik</strong>
                                        </td>
                                        <td>{book.specific_detail_info || "-"}</td>
                                    </tr>
                                    <tr>
                                        <td className="pr-20">
                                            <strong>
                                                Pernyataan Tanggungjawab
                                            </strong>
                                        </td>
                                        <td>{book.responsibility || "-"}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </main>
        </>
    );
}
