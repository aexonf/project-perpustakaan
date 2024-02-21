import React from "react";
import { Head } from "@inertiajs/react";
import Navbar from "@/components/Navbar";
import SearchBar from "@/components/SearchBar";
import { Separator } from "@/components/ui/separator";

export default function Informasi() {
    return (
        <>
            <Head title="Informasi Perpustakaan" />
            <Navbar />
            <main className="w-full px-4">
                <SearchBar />
                <section
                    className="my-10 space-y-5 w-full container"
                    id="content"
                >
                    <h1 className="text-2xl font-bold">Library Information</h1>
                    <Separator />
                    <div className="mx-10 pt-5">
                        <div className="w-full">
                            <h2 className="mb-3 text-2xl font-semibold">
                                Informasi Kontak
                            </h2>
                            <p className="text-xl">
                                Alamat: <br />
                                <strong>
                                    Jalan Raya Puspitek No. 11 Serpong, Kota
                                    Tangerang Selatan
                                </strong>{" "}
                                <br />
                                No. Telp : <strong>087725221016</strong>
                            </p>
                        </div>
                    </div>
                </section>
            </main>
        </>
    );
}
