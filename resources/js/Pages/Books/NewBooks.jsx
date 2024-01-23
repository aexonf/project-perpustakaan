import React from "react";

export default function NewBooks({ data }) {
    return (
        <div className="rounded-md p-4">
            <h3 className="text-2xl md:text-3xl font-semibold tracking-tight text-center">
                Buku Terbaru
            </h3>
            <div className="gap-4 my-4 grid md:grid-cols-4 grid-cols-2">
                {data?.length > 0 ? (
                    data?.map((book) => (
                        <div
                            className="border-black border-2 p-5 rounded-lg col-span-1"
                            key={book?.id}
                        >
                            <h4 className="text-primary text-lg md:text-xl font-semibold tracking-tight mb-2 ">
                                {book?.title}
                            </h4>
                            <p className="text-base md:text-lg">
                                Penulis : <b>{book?.writer}</b>
                            </p>
                            <p className="text-base md:text-lg">
                                Lokasi : <b>{book?.location}</b>
                            </p>
                        </div>
                    ))
                ) : (
                    <div className="flex justify-center items-center h-full">
                        <p className="text-primary text-lg md:text-xl font-semibold tracking-tight">
                            Belum ada buku yang ditambahkan.
                        </p>
                    </div>
                )}
            </div>
        </div>
    );
}
