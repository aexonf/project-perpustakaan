import React from "react";
import { Head } from "@inertiajs/react";
import Navbar from "@/components/Navbar";
import SearchBar from "@/components/SearchBar";
import { Separator } from "@/components/ui/separator";

export default function Informasi({ data }) {
    return (
        <>
            <Head title="Informasi Perpustakaan" />
            <Navbar className="h-[160px] max-h-[160px]" />
            <main className="w-full px-4">
                <SearchBar />
                <section
                    className="my-10 space-y-5 w-full container"
                    id="content"
                >
                    <h1 className="text-3xl tracking-wide font-semibold">
                        Pustakawan
                    </h1>
                    <Separator />
                    {data ? (
                        <div className="mx-10 pt-5">
                            <div className="w-full">
                                <h2 className="mb-3 text-2xl font-semibold">
                                    Kontak
                                </h2>
                                <p className="text-xl">
                                    Nama Perpustakaan: <br />
                                    <strong>
                                        {data.scholl_name || "-"}
                                    </strong>{" "}
                                    <br />
                                    <br />
                                    Alamat: <br />
                                    <strong>{data.address || "-"}</strong>{" "}
                                    <br />
                                    <br />
                                    No. Telp : <br />
                                    <strong>{data.phone_number || "-"}</strong>
                                </p>
                                <img
                                    src={`/storage/upload/setting/${data.image}`}
                                    alt=""
                                    className="w-auto h-96 rounded-md"
                                />
                            </div>
                        </div>
                    ) : (
                        <div className="text-center">
                            <h2 className="text-4xl font-bold">
                                Informasi Perpustakaan Tidak Ditemukan
                            </h2>
                        </div>
                    )}
                </section>
            </main>
        </>
    );
}
