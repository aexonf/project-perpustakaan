import React from "react";
import { Head } from "@inertiajs/react";
import Navbar from "@/components/Navbar";
import SearchBar from "@/components/SearchBar";
import { Separator } from "@/components/ui/separator";

export default function Pustakawan({ data }) {
    return (
        <>
            <Head title="Informasi Pustakawan" />
            <Navbar className="h-[160px] max-h-[160px]" />
            <main className="w-full px-4">
                <SearchBar />
                <section
                    className="my-10 space-y-5 w-full container"
                    id="content"
                >
                    <h1 className="text-3xl tracking-wide font-semibold">
                        Profil Pustakawan
                    </h1>
                    <Separator />
                    <div className="mx-10 pt-5 grid grid-cols-1 gap-5 sm:grid-cols-1 md:grid-cols-2">
                        {data.length <= 0 ? (
                            <div>
                                <h2>Tidak ada data</h2>
                            </div>
                        ) : (
                            data.map((item) => (
                                <div
                                    className="w-full p-4 flex space-x-5"
                                    key={item.id}
                                >
                                    <img
                                        className="object-contain w-36 h-auto bg-[#f3f3f3] p-4 rounded-md"
                                        src={
                                            item.image
                                                ? `storage/upload/user/${item.image}`
                                                : "/image/blank-profile.png"
                                        }
                                        alt=""
                                    />
                                    <div>
                                        <h5 className="flex w-full font-semibold">
                                            Nama :&nbsp;
                                            <strong>{item.name}</strong>
                                        </h5>
                                        <h5 className="flex w-full font-semibold">
                                            Jabatan :&nbsp;
                                            <strong>
                                                {item.role === "librarian"
                                                    ? "Pustakawan"
                                                    : item.role === "teacher"
                                                    ? "Guru"
                                                    : item.role === "student"
                                                    ? "Siswa"
                                                    : ""}
                                            </strong>
                                        </h5>
                                    </div>
                                </div>
                            ))
                        )}
                    </div>
                </section>
            </main>
        </>
    );
}
